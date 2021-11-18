DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS questions CASCADE;
DROP TABLE IF EXISTS answers CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS tags CASCADE;
DROP TABLE IF EXISTS badges CASCADE;
DROP TABLE IF EXISTS user_badges CASCADE;

DROP TYPE IF EXISTS user_role;

CREATE TYPE user_role AS ENUM ('Author', 'Moderator', 'Administrator')
CREATE TYPE badge_tier AS ENUM ('Bronze', 'Silver', 'Gold')
CREATE TYPE user_status AS ENUM ('Offline', 'Online', 'Idle', 'DoNotDisturb')

CREATE TABLE users (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    nickname varchar(15),
    password varchar(20),
    email varchar(40),
    registerDate date,
    isBlocked boolean,
    status user_status, --status type enum
    bio varchar(300),
    location varchar(50)
);

CREATE TABLE Visitor();
CREATE TABLE Author();
CREATE TABLE Moderator();
CREATE TABLE Administrator();
CREATE TABLE QuestionAuthor();
CREATE TABLE Question(
    questionId varchar(80),
    createdDate date,
    title varchar(30),
    content varchar(300),
    views int
);
CREATE TABLE tags(
    tagname varchar(15)
);
CREATE TABLE Image(
    path varchar(80)
);
CREATE TABLE badges(
    type badgetype, --badge type enum
    receivedDate date,
    title varchar(15),
    content varchar(25)
);

CREATE TABLE answers (
    lasEditedDate date,
    content varchar(500)
);

CREATE TABLE Upvoted (
    likes int,
    dislikes int
);