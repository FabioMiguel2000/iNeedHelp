SET search_path TO lbaw2153;
/*User*/
INSERT INTO "users"(username, full_name, email, password, status, bio, location, is_blocked, created_at ,updated_at) VALUES
('lugaRythm', 'Rui Pinto', 'up420000042@up.pt', 'UVBB32WI99NK', 'doNotDisturb', '42 is the solution to all questions', 'Oiã', DEFAULT, DEFAULT, DEFAULT),
('sanchovies', 'Karim Badjoras', 'up196900001@up.pt', 'H6GW4LYEUVW8', 'idle', 'here to check typos only', 'Curral de Moinas', DEFAULT, DEFAULT, DEFAULT),
('jhonnyB', 'Jhonny Bravo', 'up197400007@up.pt', 'SZZV34N3H3NR', DEFAULT, 'suck at math...', 'Porto', DEFAULT, DEFAULT, DEFAULT),
('hunnidGrams', 'Filipe Gomes', 'up143300000@up.pt', 'QP7UARLVR17D', DEFAULT, 'ready to code! :)', 'Algarve', DEFAULT, DEFAULT, DEFAULT),
('megaLaife', 'Marco Oracio', 'up450089999@up.pt', 'PGG16THOBQ1X', DEFAULT, 'hello world', 'Kingston', DEFAULT, DEFAULT, DEFAULT),
('Robyte', 'Sir Rob', 'up133745382@up.pt', '1SI9FA476TQ6', DEFAULT, 'started doing CTFs for fun', 'London', DEFAULT, DEFAULT, DEFAULT),
('VioletsRblue', 'Karen Smith', 'up55489028@up.pt', '4NCZV7M20NLM', DEFAULT, 'flowers can cure any sad day', 'Punta Cana', DEFAULT, DEFAULT, DEFAULT),
('masterMind', 'Joaquim Rosa', 'up167207718@up.pt', '37UHW05SJ2ZO', DEFAULT, 'idk what i am doing here', 'Denver', DEFAULT, DEFAULT, DEFAULT),
('inspectora', 'Raquel Murillo', 'up05667339@up.pt', 'P5R0VNEDRN21', DEFAULT, 'have you seen "la casa de papel"?', 'Nairobi', DEFAULT, DEFAULT, DEFAULT),
('loremIpsum', 'Pain Itself', 'up000000000@up.pt', '90JJXPPWKMSM', DEFAULT, 'enough users, its LOREM IPSUM time', 'Rome', DEFAULT, DEFAULT, DEFAULT);

/*Administrator*/
INSERT INTO "administrators" (user_id) VALUES (1),(2);

/*Moderator*/
INSERT INTO "moderators" (user_id) VALUES (3),(4);

/*Question*/
INSERT INTO "questions"( user_id, title, content, views, created_at, updated_at) VALUES
(3,'Need help connecting to FEUP VPN', 'Greetings, can someone please help me connect to the VPN using mac?', 5, DEFAULT, DEFAULT),
(5,'What is the second derivative of (6x-5)^-2', 'Hmmm nothing to say here really... the title is self explanatory', 13, DEFAULT, DEFAULT),
(7,'Weird dream meaning', 'Does anyone know what it means when you dream about waterfalls?', 0, DEFAULT, DEFAULT),
(9,'Arraial de Engenharia', 'Sorry, this might be the wrong place to ask but does anyone knows where to buy tickets for the party?', 78, DEFAULT, DEFAULT),
(10,'What is a NullPointerException, and how do I fix it?', 'What methods/tools can be used to determine the cause so that you stop the exception from causing the program to terminate prematurely?', 27, DEFAULT, DEFAULT);

/*Answer*/
INSERT INTO "answers"( user_id, question_id, content, created_at, updated_at) VALUES
(2, 1, 'follow these steps https://www.up.pt/it/pt/servicos/redes-e-conetividade/vpn/configuracao-manual-mac-9a6b54b9', DEFAULT, DEFAULT),
(3, 2, 'have you tried using wolfram alfa?', DEFAULT, DEFAULT),
(4, 2, 'that is easy bro, -216/(6x-5)^4', DEFAULT, DEFAULT),
(5, 4, 'dont know, because of the new pandemic restrictions...', DEFAULT, DEFAULT);

/*Comment*/
INSERT INTO "comments"( user_id, question_id, answer_id, content, created_at, updated_at) VALUES
(2, 1, null, 'its having some problems today', DEFAULT, DEFAULT),
(3, null, 1, 'thanks a lot bro!', DEFAULT, DEFAULT),
(8, null, 4, 'i dont care! i wanna party!', DEFAULT, DEFAULT);

/*Images*/
INSERT INTO "images"(id, path) VALUES
(001, 'badge_pictures/1.png'),
(002, 'badge_pictures/2.png'),
(003, 'badge_pictures/3.png'),
(004, 'badge_pictures/4.png'),
(005, 'badge_pictures/5.png'),
(101, 'profile_pictures/101.png'),
(102, 'profile_pictures/102.png'),
(103, 'profile_pictures/103.png'),
(104, 'profile_pictures/104.png');

/*Badge*/
INSERT INTO "badges"( type, title, content, image_id ) VALUES
('bronze', 'Welcome :)', 'Achieved when you activate your account',1),
('bronze', 'UpDate', 'Awarded when you update your profile for the first time',2),
('silver', 'Casual writer', 'Answered or commented on 10 different questions',3),
('silver', 'Doubt Everything!', 'Asked at  least 10 questions',4),
('gold', 'SuperMan', 'Got the correct answer in 25 different questions',5);

/*USER BADGES*/
INSERT INTO "user_badges"( user_id, badge_id, awarded_at ) VALUES
(8,1,DEFAULT),
(8,2,DEFAULT),
(9,1,DEFAULT),
(9,2,DEFAULT);

/*CORRECT ANSWER*/
UPDATE "questions" SET accepted_answer_id = 1 WHERE id = 1;

/* Question / Answer / Comment Reviews */
INSERT INTO "question_reviews"( user_id, question_id, type, reviewed_at ) VALUES
( 7, 1, 'like', DEFAULT),
( 8, 1, 'dislike', DEFAULT);

INSERT INTO "answer_reviews"( user_id, answer_id, type, reviewed_at ) VALUES
( 9, 1, 'like', DEFAULT);

INSERT INTO "comment_reviews"( user_id, comment_id, type, reviewed_at ) VALUES
( 10, 1, 'like', DEFAULT);

/*Tags*/
INSERT INTO "tags"( name ) VALUES ('Java'),('Python'),('C++'),('Math');

INSERT INTO "question_tags"(question_id, tag_id) VALUES (1, 1),(1, 2),(2, 1),(2, 2);

/*AuthenticatedUser*/

/*Visitor*/

/*Author*/

/*QuestionAuthor*/

/*Upvoted*/

