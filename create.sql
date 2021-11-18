Drof Table If Exists User;

CREATE TABLE User();
CREATE TABLE AuthenticathedUser (
    userId varchar(80),
    nickname varchar(15),
    userpassword varchar(20),
    email varchar(40),
    registerDate date,
    isBlocked boolean,
    userstatus statustype, --status type enum
    bio varchar(150),
    userlocation varchar(25)
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
CREATE TABLE Tag(
    tagname varchar(15)
);
CREATE TABLE Image(
    path varchar(80)
);
CREATE TABLE Badge(
    type badgetype, --badge type enum
    receivedDate date,
    title varchar(15),
    content varchar(25)
);

CREATE TABLE Awser (
    lasEditedDate date,
    content varchar(500)
);

CREATE TABLE Upvoted (
    likes int,
    dislikes int
);