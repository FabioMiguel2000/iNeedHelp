/*User*/
INSERT INTO "users"(username, full_name, email, password, status, bio, location, is_blocked, created_at ,updated_at) VALUES
('lugaRythm', 'Rui Pinto', 'up000000042@up.pt', 'admin', 'doNotDisturb', '42 is the solution to all questions', 'Oiã', DEFAULT, DEFAULT, DEFAULT),
('sanchovies', 'Karim Badjoras', 'up196900001@up.pt', '0000', 'idle', 'here to check typos only', 'Curral de Moinas', DEFAULT, DEFAULT, DEFAULT),
('jhonnyB', 'Jhonny Bravo', 'up197400007@up.pt', 'supersecretpassword', DEFAULT, 'suck at math...', 'Porto', DEFAULT, DEFAULT, DEFAULT),
('hunnidGrams', 'Filipe Gomes', 'up143300000@up.pt', 'banana123', DEFAULT, 'ready to code! :)', 'Algarve', DEFAULT, DEFAULT, DEFAULT),
('megaLaife', 'Marco Oracio', 'up450089999@up.pt', 'sporting55', DEFAULT, 'hello world', 'Coimbra', DEFAULT, DEFAULT, DEFAULT),
('masterMind', 'Joaquim Rosa', 'up167207718@up.pt', 'trocar_pw_p/_hash!', DEFAULT, 'tou sem inspiração  xD', 'Lisboa', DEFAULT, DEFAULT, DEFAULT);


/*Administrator*/
INSERT INTO "administrators" (user_id) VALUES (1),(2);

/*Moderator*/
INSERT INTO "moderators" (user_id) VALUES (3),(4);

/*AuthenticatedUser*/

/*Visitor*/

/*Author*/

/*QuestionAuthor*/

/*Question*/

/*Tag*/

/*Image*/

/*Badge*/

/*Awser*/

/*Upvoted*/

/*Comment*/
