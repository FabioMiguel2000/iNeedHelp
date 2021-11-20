DROP TYPE IF EXISTS badge_type CASCADE;
DROP TYPE IF EXISTS status_type CASCADE;
DROP TYPE IF EXISTS user_role CASCADE;

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS questions CASCADE;
DROP TABLE IF EXISTS tags CASCADE;
DROP TABLE IF EXISTS question_tags CASCADE;
DROP TABLE IF EXISTS answers CASCADE;
DROP TABLE IF EXISTS comments CASCADE;

DROP TABLE IF EXISTS Image CASCADE;

DROP TABLE IF EXISTS badges CASCADE;
DROP TABLE IF EXISTS user_badges CASCADE;

DROP TABLE IF EXISTS upvotable CASCADE;

CREATE TYPE badge_type AS ENUM (
    'goldBadge',
    'silverBadge',
    'bronzeBadge'
    );

CREATE TYPE status_type AS ENUM (
    'active',
    'inactive',
    'idle',
    'doNotDisturb'
    );

CREATE TYPE user_role AS ENUM (
    'Author',
    'Moderator',
    'Administrator'
    );

CREATE TABLE users
(
    id         UUID PRIMARY KEY      DEFAULT gen_random_uuid(),

    nickname   VARCHAR(25)  NOT NULL UNIQUE CHECK ( length(nickname) >= 3 ),
    full_name  VARCHAR(100),
    email      VARCHAR(320) NOT NULL UNIQUE CHECK (VALUE LIKE '%@%._%'),
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

-- CREATE TABLE Author
-- (
--     auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
-- );
-- CREATE TABLE Moderator
-- (
--     auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
-- );
-- CREATE TABLE Administrator
-- (
--     auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
-- );
-- CREATE TABLE QuestionAuthor
-- (
--     author PRIMARY KEY REFERENCES Author ON UPDATE CASCADE ON DELETE SET NULL
-- );

CREATE TABLE questions
(
    id         UUID PRIMARY KEY        DEFAULT gen_random_uuid(),

    title      VARCHAR(100)   NOT NULL CHECK ( length(title) >= 10 ),
    content    VARCHAR(10000) NOT NULL CHECK ( length(content) >= 20 ),
    views      BIGINT         NOT NULL DEFAULT 0 CHECK ( views >= 0 ),

    created_at TIMESTAMP      NOT NULL DEFAULT now(),
    updated_at TIMESTAMP      NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

CREATE TABLE tags
(
    id   UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(30) NOT NULL CHECK ( length(name) >= 1 )
);

CREATE TABLE question_tags
(
    PRIMARY KEY (question_id, tag_id),
    question_id UUID REFERENCES questions (id) ON UPDATE CASCADE,
    tag_id      UUID REFERENCES tags (id) ON UPDATE CASCADE
);

CREATE TABLE answers
(
    id          UUID PRIMARY KEY        DEFAULT gen_random_uuid(),

    user_id     UUID           NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
    question_id UUID           NOT NULL REFERENCES questions (id) ON UPDATE CASCADE,
    CONSTRAINT ck_one_answer_per_user UNIQUE (user_id, question_id),

    content     VARCHAR(10000) NOT NULL CHECK ( length(content) >= 20 ),

    created_at  TIMESTAMP      NOT NULL DEFAULT now(),
    updated_at  TIMESTAMP      NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

CREATE TABLE comments
(
    id          UUID PRIMARY KEY       DEFAULT gen_random_uuid(),
    user_id     UUID          NOT NULL REFERENCES users (id) ON UPDATE CASCADE,

    question_id UUID REFERENCES questions (id) ON UPDATE CASCADE,
    answer_id   UUID REFERENCES answers (id) ON UPDATE CASCADE,
    CONSTRAINT ck_belongs_to_question_xor_answer CHECK ( question_id IS NULL != answer_id IS NULL ),

    content     VARCHAR(1000) NOT NULL CHECK ( length(content) >= 2 ),

    created_at  TIMESTAMP     NOT NULL DEFAULT now(),
    updated_at  TIMESTAMP     NOT NULL DEFAULT now(),
    CONSTRAINT ck_updated_after_created CHECK ( updated_at >= created_at )
) INHERITS (upvotable);

CREATE TABLE Image
(
    imagePath TEXT NOT NULL
);

CREATE TABLE badges
(
    id      UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    type    badge_type   NOT NULL,
    title   VARCHAR(25)  NOT NULL CHECK ( length(title) >= 2 ),
    content VARCHAR(100) NOT NULL
);

CREATE TABLE user_badges
(
    PRIMARY KEY (user_id, badge_id),
    user_id    UUID REFERENCES users (id) ON UPDATE CASCADE,
    badge_id   UUID REFERENCES badges (id) ON UPDATE CASCADE,

    awarded_at TIMESTAMP NOT NULL DEFAULT now()
);

-- cuidado ao usar hereditariedade
-- https://www.postgresql.org/docs/current/ddl-inherit.html#DDL-INHERIT-CAVEATS
CREATE TABLE upvotable
(
    likes    INTEGER NOT NULL CHECK ( likes >= 0 ),
    dislikes INTEGER NOT NULL CHECK ( dislikes >= 0 )
);
