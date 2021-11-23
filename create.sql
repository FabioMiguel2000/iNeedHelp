--para nao usar o schema 'public' (monitor sessions around 30min)
DROP SCHEMA IF EXISTS lbaw2153 CASCADE;
CREATE SCHEMA lbaw2153;
SET search_path TO lbaw2153;

DROP TYPE IF EXISTS "badge_type" CASCADE;
DROP TYPE IF EXISTS "status_type" CASCADE;
DROP TYPE IF EXISTS "user_role" CASCADE;

DROP TABLE IF EXISTS "users" CASCADE;
DROP TABLE IF EXISTS "questions" CASCADE;
DROP TABLE IF EXISTS "tags" CASCADE;
DROP TABLE IF EXISTS "question_tags" CASCADE;
DROP TABLE IF EXISTS "answers" CASCADE;
DROP TABLE IF EXISTS "comments" CASCADE;

DROP TABLE IF EXISTS "image" CASCADE;

DROP TABLE IF EXISTS "badges" CASCADE;
DROP TABLE IF EXISTS "user_badges" CASCADE;

DROP TABLE IF EXISTS "upvotable" CASCADE;

CREATE TYPE "badge_type" AS ENUM (
    'goldBadge',
    'silverBadge',
    'bronzeBadge'
    );

CREATE TYPE "status_type" AS ENUM (
    'active',
    'inactive',
    'idle',
    'doNotDisturb'
    );

CREATE TYPE "user_role" AS ENUM (
    'Author',
    'Moderator',
    'Administrator'
    );

CREATE TABLE "users"
(
    id         SERIAL PRIMARY KEY,

    username   VARCHAR(25)  NOT NULL UNIQUE CHECK ( length(username) >= 3 ),
    full_name  VARCHAR(100),
    email      VARCHAR(320) NOT NULL UNIQUE CHECK (email LIKE '%@%._%'),
    password   TEXT         NOT NULL,

    role       user_role    NOT NULL DEFAULT 'Author',
    isBlocked  BOOLEAN      NOT NULL DEFAULT FALSE,

    status     status_type  NOT NULL DEFAULT 'active',
    bio        VARCHAR(300),
    location   VARCHAR(100),

    created_at TIMESTAMP    NOT NULL DEFAULT now(),
    updated_at TIMESTAMP    NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
);

-- https://www.postgresql.org/docs/current/ddl-inherit.html#DDL-INHERIT-CAVEATS
CREATE TABLE "upvotable"
(
    likes    INTEGER NOT NULL DEFAULT 0 CHECK ( likes >= 0 ),
    dislikes INTEGER NOT NULL DEFAULT 0 CHECK ( dislikes >= 0 )
);

CREATE TABLE "questions"
(
    id         SERIAL PRIMARY KEY,
    user_id    INTEGER        NOT NULL REFERENCES users (id) ON UPDATE CASCADE,

    title      VARCHAR(100)   NOT NULL CHECK ( length(title) >= 10 ),
    content    VARCHAR(10000) NOT NULL CHECK ( length(content) >= 20 ),
    views      BIGINT         NOT NULL DEFAULT 0 CHECK ( views >= 0 ),

    created_at TIMESTAMP      NOT NULL DEFAULT now(),
    updated_at TIMESTAMP      NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

CREATE TABLE "tags"
(
    id   SERIAL PRIMARY KEY,
    name VARCHAR(30) NOT NULL CHECK ( length(name) >= 1 )
);

CREATE TABLE "question_tags"
(
    PRIMARY KEY (question_id, tag_id),
    question_id INTEGER REFERENCES "questions" (id) ON UPDATE CASCADE,
    tag_id      INTEGER REFERENCES "tags" (id) ON UPDATE CASCADE
);

CREATE TABLE "answers"
(
    id          SERIAL PRIMARY KEY,

    user_id     INTEGER        NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    question_id INTEGER        NOT NULL REFERENCES questions (id) ON UPDATE CASCADE,
    CONSTRAINT ck_one_answer_per_user UNIQUE (user_id, question_id),

    content     VARCHAR(10000) NOT NULL CHECK ( length(content) >= 20 ),

    created_at  TIMESTAMP      NOT NULL DEFAULT now(),
    updated_at  TIMESTAMP      NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

ALTER TABLE "questions"
    ADD COLUMN
        accepted_answer_id INTEGER REFERENCES answers (id) ON UPDATE CASCADE;

CREATE TABLE "comments"
(
    id          SERIAL PRIMARY KEY,
    user_id     INTEGER       NOT NULL REFERENCES users (id) ON UPDATE CASCADE,

    question_id INTEGER REFERENCES questions (id) ON UPDATE CASCADE,
    answer_id   INTEGER REFERENCES answers (id) ON UPDATE CASCADE,
    CONSTRAINT ck_belongs_to_question_xor_answer CHECK ( (question_id IS NULL) != (answer_id IS NULL) ),

    content     VARCHAR(1000) NOT NULL CHECK ( length(content) >= 2 ),

    created_at  TIMESTAMP     NOT NULL DEFAULT now(),
    updated_at  TIMESTAMP     NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

CREATE TABLE "image"
(
    imagePath TEXT NOT NULL
);

CREATE TABLE "badges"
(
    id      SERIAL PRIMARY KEY,
    type    badge_type   NOT NULL,
    title   VARCHAR(25)  NOT NULL CHECK ( length(title) >= 2 ),
    content VARCHAR(100) NOT NULL
);

CREATE TABLE "user_badges"
(
    PRIMARY KEY (user_id, badge_id),
    user_id    INTEGER REFERENCES "users" (id) ON UPDATE CASCADE,
    badge_id   INTEGER REFERENCES "badges" (id) ON UPDATE CASCADE,

    awarded_at TIMESTAMP NOT NULL DEFAULT now()
);

-- Indexes

CREATE INDEX user_question ON questions USING hash (user_id);
CREATE INDEX created_question ON questions USING btree (created_at);
CREATE INDEX updated_question ON questions USING btree (updated_at);
CREATE INDEX likes_question ON questions USING btree (likes);
CREATE INDEX dislikes_question ON questions USING btree (dislikes);

CREATE INDEX user_answer ON answers USING hash (user_id);
CREATE INDEX question_answer ON answers USING hash (question_id);
CREATE INDEX created_answer ON answers USING btree (created_at);
-- CREATE INDEX updated_answer ON answers USING btree (updated_at);
CREATE INDEX likes_answer ON answers USING btree (likes);
CREATE INDEX dislikes_answer ON answers USING btree (dislikes);

CREATE INDEX user_comment ON comments USING hash (user_id);
CREATE INDEX question_comment ON comments USING hash (question_id);
CREATE INDEX answer_comment ON comments USING hash (answer_id);
CREATE INDEX created_comment ON comments USING btree (created_at);

-- Triggers

-- TRIGGER01
-- The accepted answer of a question must belong to itself and not some other question
CREATE FUNCTION check_accepted() RETURNS TRIGGER AS
$BODY$
DECLARE
    q_id INTEGER;
BEGIN
    SELECT question_id INTO q_id FROM answers WHERE id = NEW.accepted_answer_id;

    IF NEW.accepted_answer_id IS NOT NULL AND q_id != OLD.id THEN
        RAISE EXCEPTION 'The accepted answer does not belong to this question';
    end if;

    RETURN NEW;
END
$BODY$
    LANGUAGE plpgsql;

CREATE TRIGGER check_accepted
    BEFORE INSERT OR UPDATE
    ON questions
    FOR EACH ROW
EXECUTE PROCEDURE check_accepted();
