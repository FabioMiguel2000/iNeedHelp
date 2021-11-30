--para nao usar o schema 'public'
DROP SCHEMA IF EXISTS lbaw2153 CASCADE;
CREATE SCHEMA lbaw2153;
SET search_path TO lbaw2153;

DROP TYPE IF EXISTS "badge_type" CASCADE;
DROP TYPE IF EXISTS "status_type" CASCADE;
DROP TYPE IF EXISTS "review_type" CASCADE;

DROP TABLE IF EXISTS "users" CASCADE;
DROP TABLE IF EXISTS "moderators" CASCADE;
DROP TABLE IF EXISTS "administrators" CASCADE;
DROP TABLE IF EXISTS "questions" CASCADE;
DROP TABLE IF EXISTS "tags" CASCADE;
DROP TABLE IF EXISTS "question_tags" CASCADE;
DROP TABLE IF EXISTS "answers" CASCADE;
DROP TABLE IF EXISTS "comments" CASCADE;
DROP TABLE IF EXISTS "images" CASCADE;

DROP TABLE IF EXISTS "badges" CASCADE;
DROP TABLE IF EXISTS "user_badges" CASCADE;

DROP TABLE IF EXISTS "question_reviews" CASCADE;
DROP TABLE IF EXISTS "answer_reviews" CASCADE;
DROP TABLE IF EXISTS "comment_reviews" CASCADE;

CREATE TYPE "badge_type" AS ENUM ( 'gold', 'silver', 'bronze' );
CREATE TYPE "status_type" AS ENUM ( 'active', 'inactive', 'idle', 'doNotDisturb');
CREATE TYPE "review_type" AS ENUM ('like', 'dislike' );

CREATE DOMAIN "timestamp_t" AS TIMESTAMP NOT NULL DEFAULT NOW();
CREATE DOMAIN "email_t" AS VARCHAR(320) NOT NULL CHECK (VALUE LIKE '_%@_%._%');

CREATE TABLE "images"
(
    id   SERIAL PRIMARY KEY,
    path TEXT NOT NULL UNIQUE
);

CREATE TABLE "users"
(
    id               SERIAL PRIMARY KEY,

    username         VARCHAR(25)  NOT NULL UNIQUE CHECK ( length(username) >= 3 ),
    full_name        VARCHAR(100),
    email            email_t,
    password         TEXT         NOT NULL,

    status           status_type  NOT NULL DEFAULT 'active',
    bio              VARCHAR(300),
    location         VARCHAR(100),
    profile_image_id INTEGER REFERENCES "images" (id) ON UPDATE CASCADE,

    is_blocked       BOOLEAN      NOT NULL DEFAULT FALSE,

    created_at       timestamp_t,
    updated_at       timestamp_t,
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
);

CREATE TABLE "moderators"
(
    user_id INTEGER PRIMARY KEY REFERENCES "users" (id) ON DELETE CASCADE
);

CREATE TABLE "administrators"
(
    user_id INTEGER PRIMARY KEY REFERENCES "users" (id) ON DELETE CASCADE
);

CREATE TABLE "questions"
(
    id         SERIAL PRIMARY KEY,
    user_id    INTEGER        NOT NULL REFERENCES users (id) ON UPDATE CASCADE,

    title      VARCHAR(100)   NOT NULL CHECK ( length(title) >= 10 ),
    content    VARCHAR(10000) NOT NULL CHECK ( length(content) >= 10 ),
    views      BIGINT         NOT NULL DEFAULT 0 CHECK ( views >= 0 ),

    created_at timestamp_t,
    updated_at timestamp_t,
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
);

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

    content     VARCHAR(10000) NOT NULL CHECK ( length(content) >= 10 ),

    created_at  timestamp_t,
    updated_at  timestamp_t,
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
);

-- Use ALTER to avoid "table doesn't exist" errors
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

    created_at  timestamp_t,
    updated_at  timestamp_t,
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
);

CREATE TABLE "badges"
(
    id       SERIAL PRIMARY KEY,
    type     badge_type   NOT NULL,
    title    VARCHAR(25)  NOT NULL CHECK ( length(title) >= 2 ),
    content  VARCHAR(100) NOT NULL,
    image_id INTEGER REFERENCES "images" (id) ON UPDATE CASCADE
);

CREATE TABLE "user_badges"
(
    PRIMARY KEY (user_id, badge_id),
    user_id    INTEGER REFERENCES "users" (id) ON UPDATE CASCADE,
    badge_id   INTEGER REFERENCES "badges" (id) ON UPDATE CASCADE,

    awarded_at timestamp_t
);

CREATE TABLE "question_reviews"
(
    PRIMARY KEY (user_id, question_id),
    user_id     INTEGER REFERENCES "users" (id) ON UPDATE CASCADE,
    question_id INTEGER REFERENCES "questions" (id) ON UPDATE CASCADE,

    type        review_type NOT NULL,
    reviewed_at timestamp_t
);

CREATE TABLE "answer_reviews"
(
    PRIMARY KEY (user_id, answer_id),
    user_id     INTEGER REFERENCES "users" (id) ON UPDATE CASCADE,
    answer_id   INTEGER REFERENCES "answers" (id) ON UPDATE CASCADE,

    type        review_type NOT NULL,
    reviewed_at timestamp_t
);

CREATE TABLE "comment_reviews"
(
    PRIMARY KEY (user_id, comment_id),
    user_id     INTEGER REFERENCES "users" (id) ON UPDATE CASCADE,
    comment_id  INTEGER REFERENCES "comments" (id) ON UPDATE CASCADE,

    type        review_type NOT NULL,
    reviewed_at timestamp_t
);

-- Indexes

CREATE INDEX user_question ON "questions" USING hash (user_id);
CREATE INDEX created_question ON "questions" USING btree (created_at);
CREATE INDEX updated_question ON "questions" USING btree (updated_at);
CLUSTER "questions" USING updated_question;

CREATE INDEX created_answer ON "answers" USING btree (created_at);
CREATE INDEX user_answer ON "answers" USING hash (user_id);
CREATE INDEX question_answer ON "answers" USING btree (question_id);
CLUSTER "answers" USING question_answer;

CREATE INDEX user_comment ON "comments" USING hash (user_id);
CREATE INDEX question_comment ON "comments" USING hash (question_id);
CREATE INDEX answer_comment ON "comments" USING hash (answer_id);
CREATE INDEX created_comment ON "comments" USING btree (created_at);
CLUSTER "comments" USING created_comment;

CREATE INDEX type_question_review ON "question_reviews" USING hash (type);
CREATE INDEX type_answer_review ON "answer_reviews" USING hash (type);
CREATE INDEX type_comment_review ON "comment_reviews" USING hash (type);

-- FTS Indexes

ALTER TABLE questions
    ADD COLUMN ts_vectors TSVECTOR;

CREATE FUNCTION questions_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.ts_vectors = (
                setweight(to_tsvector('english', NEW.title), 'A') ||
                setweight(to_tsvector('english', NEW.content), 'B')
            );
    END IF;

    IF TG_OP = 'UPDATE' THEN
        IF (NEW.title != OLD.title OR NEW.content != OLD.content) THEN
            NEW.ts_vectors = (
                    setweight(to_tsvector('english', NEW.title), 'A') ||
                    setweight(to_tsvector('english', NEW.content), 'B')
                );
        END IF;
    END IF;

    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER questions_search_update
    BEFORE INSERT OR UPDATE
    ON questions
    FOR EACH ROW
EXECUTE PROCEDURE questions_search_update();

CREATE INDEX search_idx ON questions USING gin (ts_vectors);

-- Triggers

-- TRIGGER01
-- The accepted answer of a question must belong to itself and not some other question
CREATE FUNCTION check_accepted() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.accepted_answer_id IS NOT NULL AND
       NOT EXISTS(SELECT * FROM "answers" WHERE id = NEW.accepted_answer_id AND question_id = NEW.id) THEN
        RAISE EXCEPTION 'The answer (id: %) does not belong to this question (id: %)', NEW.accepted_answer_id, NEW.id;
    END IF;

    RETURN NEW;
END
$BODY$
    LANGUAGE plpgsql;

CREATE TRIGGER check_accepted
    BEFORE INSERT OR UPDATE
    ON questions
    FOR EACH ROW
EXECUTE PROCEDURE check_accepted();
