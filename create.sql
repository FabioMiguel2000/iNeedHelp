DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS AuthenticatedUser;
DROP TABLE IF EXISTS Visitor;
DROP TABLE IF EXISTS Author;
DROP TABLE IF EXISTS Moderator;
DROP TABLE IF EXISTS Administrator;
DROP TABLE IF EXISTS QuestionAuthor;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS Badge;
DROP TABLE IF EXISTS Awser;
DROP TABLE IF EXISTS Upvoted;
DROP TABLE IF EXISTS Comment;

CREATE TYPE BadgeType AS ENUM (
    'goldBadge',
    'silverBadge',
    'bronzeBadge'
);
CREATE TYPE StatusType AS ENUM (
    'active',
    'inactive',
    'idle',
    'doNotDisturb'
)
CREATE TABLE User();
CREATE TABLE AuthenticatedUser (
    userId VARCHAR(64) NOT NULL UNIQUE,
    nickname VARCHAR(25) NOT NULL UNIQUE,
    userpassword TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE CHECK(VALUE LIKE '%@%._%'),
    registerDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP() CHECK(registerDate >= CURRENT_TIME),
    isBlocked INTEGER DEFAULT 0,
    statusType StatusType NOT NULL,
    bio TEXT,
    userlocation TEXT,
    CONSTRAINT blockedBoolean CHECK (isBlocked == 0 OR isBlocked == 1) 
);

CREATE TABLE Visitor();
CREATE TABLE Author(
    auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE TABLE Moderator(
    auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE TABLE Administrator(
    auth_user PRIMARY KEY REFERENCES AuthenticatedUser ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE TABLE QuestionAuthor(
    author PRIMARY KEY REFERENCES Author ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE TABLE Question(
    questionId VARCHAR(64) NOT NULL UNIQUE,
    createdDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP() CHECK(createdDate >= CURRENT_TIME),
    title VARCHAR(35) NOT NULL,
    content TEXT NOT NULL,
    views INTEGER NOT NULL CHECK(views >= 0)
);
CREATE TABLE Tag(
    tagname VARCHAR(25) NOT NULL
);
CREATE TABLE Image(
    imagePath TEXT NOT NULL
);
CREATE TABLE badges(
    badgeType BadgeType NOT NULL,
    receivedDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP() CHECK(receivedDate >= CURRENT_TIME),
    title VARCHAR(25) NOT NULL,
    content VARCHAR(35) NOT NULL
);

CREATE TABLE Awser (
    lasEditedDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP() CHECK(lasEditedDate >= CURRENT_TIME),
    content VARCHAR(500) NOT NULL
);

CREATE TABLE Upvoted (
    likes INTEGER NOT NULL CHECK(likes >= 0),
    dislikes INTEGER NOT NULL CHECK(dislikes >= 0)
);

CREATE TABLE Comment (
    lasEditedDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP() CHECK(lasEditedDate >= CURRENT_TIME),
    content TEXT NOT NULL
);