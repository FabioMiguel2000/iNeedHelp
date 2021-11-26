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
('loremIpsum', 'Pain Itself', 'up000000000@up.pt', '90JJXPPWKMSM', DEFAULT, 'enough users, its LOREM IIPSUM time', 'Rome', DEFAULT, DEFAULT, DEFAULT);

/*Administrator*/
INSERT INTO "administrators" (user_id) VALUES (1),(2);

/*Moderator*/
INSERT INTO "moderators" (user_id) VALUES (3),(4);

/*Question*/
INSERT INTO "questions"( user_id, title, content, views, created_at, updated_at) VALUES
(3,'Need help connecting to FEUP VPN', 'Greetings, can someone please help me connect to the VPN using mac?', 5, DEFAULT, DEFAULT),
(5,'What is the second derivative of (6x-5)^-2', 'Hmmm nothing to say here really... the title is self explanatory', 13, DEFAULT, DEFAULT),
(6,'Weird dream meaning', 'Does anyone know what it means when you dream about waterfalls?', 0, DEFAULT, DEFAULT),
(7,'Arraial de Engenharia', 'Sorry, this might be the wrong place to ask but does anyone knows where to buy tickets for the party?', 78, DEFAULT, DEFAULT);

/*Awser*/
INSERT INTO "answers"( user_id, question_id, content, created_at, updated_at) VALUES
(2, 1, 'follow these steps https://www.up.pt/it/pt/servicos/redes-e-conetividade/vpn/configuracao-manual-mac-9a6b54b9', DEFAULT, DEFAULT),
(3, 2, 'have you tried using wolfram alfa?', DEFAULT, DEFAULT),
(4, 2, 'that is easy bro, -216/(6x-5)^4', DEFAULT, DEFAULT),
(5, 4, 'dont know, because of the new pandemic restrictions...', DEFAULT, DEFAULT);

/*Comment*/
--INSERT INTO "comments"( user_id, question_id, answer_id, content, created_at, updated_at) VALUES
--(3,?,1, 'thanks a lot bro!', DEFAULT, DEFAULT);
--(8,?,4, 'i dont care! i wanna party!', DEFAULT, DEFAULT)


/*AuthenticatedUser*/

/*Visitor*/

/*Author*/

/*QuestionAuthor*/

/*Tag*/

/*Image*/

/*Badge*/

/*Upvoted*/

