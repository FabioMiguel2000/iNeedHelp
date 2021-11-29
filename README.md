
## A4: Conceptual Data Model

The aim of this artifact is to provide a clear and concise representation of the project's entities and its associations, multiplicity and roles.

### 1. Class diagram

![Figure 1: iNeedHelp conceptual data model in UML](https://git.fe.up.pt/lbaw/lbaw2122/lbaw2153/-/raw/main/datamodel/datamodel.png)

### 2. Additional Business Rules

- BR01. A Comment belongs to a Question or Answer but not both

---

## A5: Relational Schema, validation and schema refinement

This artifact contains the Relational Schema obtained by mapping from the Conceptual Data Model. The Relational Schema includes each relation schema, attributes, domains, primary keys, foreign keys and other integrity rules to ensure data consistency and sanity
There are also some abbreviations and domains to aid with the compactness of the schema

### 1. Relational Schema

Below is a textual table representation of the relational schemas

| Relation reference | Relation Compact Notation                                                                                                                                                                                                                                   |
|--------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| R01                | users(__id__, username NN UK, full_name, email email_t, password NN, status status_type NN, bio, location, profile_image_id -> images, is_blocked NN DF FALSE, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at) |
| R02                | moderators(__id__ -> users)                                                            |    |
| R03                | administrators(__id__ -> users) |
| R04                | questions(__id__ users_id -> users NN, title NN, content NN, views NN CK views >= 0, accepted_answer_id -> answers, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                        |
| R05                | tags(__id__, name NN)                                                                                                                                                                                                                                       |
| R06                | reviews(__id__, type review_type, reviewed_at timestamp_r)                                                                                                                                                                                                                                       |
| R07                | question_tag(__question_id__ -> questions, __tag_id__ -> tag)                                                                                                                                                                                             |
| R08                | answers(__id__, user_id -> users NN, question_id -> questions NN, content NN, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                                                       |
| R09                | comments(__id__, user_id -> users NN, question_id -> questions, answer_id -> answers, content NN, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                                   |
| R10                | badges(__id__, type badge_type NN, title NN, content NN, image_id -> images)                                                                                                                                                                                |
| R11                | user_badges(__user_id__ -> users, __badge_id__ -> badge, awarded_at timestamp_r)                                                                                                                                                                             |
| R12                | images(__id__, path NN UK)                                                                                                                                                                                                                                  |
| R13                | question_reviews(__user_id__ -> users, __question_id__ -> questions, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                              |
| R14                | answer_reviews(__user_id__ -> users, __answer_id__ -> answers, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                                    |
| R15                | comment_reviews(__user_id__ -> users, __comment_id__ -> comment, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                                 |                                                                                                                                                                                                          |

### 2. Domains

Specification of additional domains:

| Domain Name | Domain Specification                               |
|-------------|----------------------------------------------------|
| email_t     | NOT NULL UNIQUE CHECK (email LIKE '_%@_%.__%')     |
| timestamp_t | TIMESTAMP NOT NULL DEFAULT NOW()                   |
| status_type | ENUM('active', 'inactive', 'idle', 'doNotDisturb') |
| badge_type  | ENUM('gold', 'silver', 'bronze')                   |
| review_type | ENUM('like', 'dislike')                          |


Legend:

- UK = UNIQUE KEY
- NN = NOT NULL
- DF = DEFAULT
- CK = CHECK

### 3. Schema validation

| **Table R01 {users}**        |                                                                                                                               |
|------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| **Keys:**                    | { id }, { email }, { username }                                                                                           |
| **Functional Dependencies:** |                                                                                                                               |
| FD0101                       | id → { full_name, username, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0102                       | username → { full_name, id, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0103                       | email   → { full_name, id, password, username, created_at, updated_at, is_blocked, status, bio, location, profile_image } |
| **NORMAL FORM**              | BCNF                                                                                                                          |

| **Table R02 {moderator}**   |             |
|------------------------------|-------------|
| **Keys:**                    | { id } |
| **Functional Dependencies:** | none        |
| **NORMAL FORM**              | BCNF        |

| **Table R03 {administrator}** |             |
|--------------------------------|-------------|
| **Keys:**                      | { id } |
| **Functional Dependencies:**   | none        |
| **NORMAL FORM**                | BCNF        |

| **Table R04 {questions}**    |                                                                        |
|------------------------------|------------------------------------------------------------------------|
| **Keys:**                    | { id }, {accepted_answer_id}                                      |
| **Functional Dependencies:** |                                                                        |
| FD0401                       | { id } → {created_at, updated_at, title, content, views, accepted_answer_id} |
| FD0402                       | { accepted_answer_id } → {created_at, updated_at, title, content, views, id} |
| **NORMAL FORM**              | BCNF                                                                   |

| **Table R05 {tag}**         |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD0501                       | { id } → { name } |
| **NORMAL FORM**              | BCNF              |

| **Table R06 {reviews}**         |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD0601                       | { id } → { type,  reviewed_at} |
| **NORMAL FORM**              | BCNF              |

| **Table R07 {question_tag}** |                         |
|-------------------------------|-------------------------|
| **Keys:**                     | { question_id, tag_id } |
| **Functional Dependencies:**  | none                    |
| **NORMAL FORM**               | BCNF                    |

| **Table R08 {answers}**      |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { id }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD0801                       | { id } → {question_id, user_id, lastEditedDate, content, created_at, updated_at} |
| **NORMAL FORM**              | BCNF                                                              |


| **Table R09 {comment}**     |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { id }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD0901                       | { id } → {user_id, question_id, answer_id, created_at, updated_at, content } |
| **NORMAL FORM**              | BCNF                                                              |

| **Table R10 {badge}**       |                                                                     |
|------------------------------|---------------------------------------------------------------------|
| **Keys:**                    | { id }                                                              |
| **Functional Dependencies:** |                                                                     |
| FD1001                       | { id } → { type, title, content, image_id} |
| **NORMAL FORM**              | BCNF                                                                |


| **Table R11 {user_badges}**       |                                                                     |
|------------------------------|---------------------------------------------------------------------|
| **Keys:**                    | {user_id, badge_id}                                                              |
| **Functional Dependencies:** |                                                                     |
| FD1101                       | { user_id, badge_id} → {awarded_at} |
| **NORMAL FORM**              | BCNF                                                                |

| **Table R12 {images}**       |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD1201                       | { id } → { path } |
| **NORMAL FORM**              | BCNF              |

| **Table R13 {question_reviews}**       |                   |
|------------------------------|-------------------|
| **Keys:**                    | { user_id, question_id }            |
| **Functional Dependencies:** |                   |
| FD1301                       | { user_id, question_id } → { type,  reviewed_at } |
| **NORMAL FORM**              | BCNF              |


| **Table R14 {answer_reviews}**       |                   |
|------------------------------|-------------------|
| **Keys:**                    | { user_id, answer_id }            |
| **Functional Dependencies:** |                   |
| FD1401                       | { user_id, answer_id } → { type,  reviewed_at } |
| **NORMAL FORM**              | BCNF              |


| **Table R15 {comment_reviews}**       |                   |
|------------------------------|-------------------|
| **Keys:**                    | { user_id, comment_id }            |
| **Functional Dependencies:** |                   |
| FD1501                       | { user_id, comment_id } → { type,  reviewed_at } |
| **NORMAL FORM**              | BCNF              |



---

## A6: Indexes, triggers, transactions and database population

This artefact the identification and characterization of the indexes, queries as well as the script to create and populate the database

### 1. Database Workload

| **Relation reference** | **Relation Name** | **Order of magnitude** | **Estimated growth** |
|------------------------|-------------------|------------------------|----------------------|
| R01                    | users             | thousands              | tens / day           |
| R02                    | moderators       | hundreds               | tens / year          |
| R03                    | administrators    | dozens                 | units / year         |
| R04                    | questions         | thousands              | dozens / day         |
| R05                    | tags              | hundreds               | units / day          |
| R06                    | reviews         | tens of thousands              | hundreds / day         |
| R07                    | question_tags     | tens of thousands      | hundreds / day       |
| R08                    | answers           | tens of thousands      | hundreds / day       |
| R09                    | comments          | tens of thousands      | hundreds / day       |
| R10                    | badges            | dozens                 | units / year         |
| R11                    | user_badges       | hundreds               | units / day          |
| R12                    | images            | thousands              | dozens / day         |
| R13                    | question_reviews  | tens of thousands      | hundreds / day       |
| R14                    | answer_reviews    | tens of thousands      | hundreds / day       |
| R15                    | comment_reviews   | thousands              | dozens / day         |

#### Frequent Queries
| **Query**   | **SELECT 01**|
|------------ |--------------|
| Description | Login        |
| Frequency   | Hundreds per day  |
```sql
SELECT id 
FROM "users" 
WHERE 
    username = $username 
    AND password = $password;

SELECT id 
FROM "users" 
WHERE 
    email = $email 
    AND password = $password;
```
  
| **Query**   | **SELECT 02**|
|------------ |--------------|
| Description | User Profile       |
| Frequency   | Hundreds per day  |
```sql
SELECT username, full_name, email, status, bio, location, profile_image_id 
FROM "users"  WHERE  "users".id = $id;
```

| **Query**   | **SELECT 03**|
|------------ |--------------|
| Description | View Question      |
| Frequency   | Thousands per day  |
```sql
SELECT * FROM "questions"  WHERE  "questions".id = $question_id;
```

| **Query**   | **SELECT 04**|
|------------ |--------------|
| Description | Question's Answers |
| Frequency   | Thousands per day  |
```sql
SELECT * FROM "answers" WHERE question_id = $question_id;
```

| **Query**   | **SELECT 05**|
|------------ |--------------|
| Description | Answers's Comments |
| Frequency   | Thousands per day  |
```sql
SELECT * FROM "comments" WHERE answer_id = $answer_id;
```

#### Frequent Updates

| **Query**   | **Insert 01**|
|------------ |--------------|
| Description | New user |
| Frequency   | Tens per day  |
```sql
INSERT INTO "users"(username, full_name, email, password, status, bio, location, created_at ) 
VALUES ($username, $full_name, $email, $password, $status, $bio, $location, $created_at);
```

| **Query**   | **Insert 02**|
|------------ |--------------|
| Description | New Question |
| Frequency   | Dozens per day  |

```sql
INSERT INTO "questions"( user_id, title, content, created_at) 
VALUES ( $user_id, $title, $content, $created_at);
```

| **Query**   | **Insert 03**|
|------------ |--------------|
| Description | New Answer |
| Frequency   | Hundreds per day  |

```sql
INSERT INTO "answers"( user_id, question_id, content, created_at) 
VALUES ( $user_id, $question_id, $content, $created_at);
```

| **Query**   | **Insert 04**|
|------------ |--------------|
| Description | New Comment |
| Frequency   | Hundreds per day  |

```sql
INSERT INTO "comments"( user_id, question_id, answer_id, content, created_at, updated_at) 
VALUES ( $user_id, $question_id, $answer_id, $content, $created_at,);
```


| **Query**   | **Update 01**|
|------------ |--------------|
| Description | Mark answer as correct |
| Frequency   | Dozens per day  |
```sql
UPDATE "questions" 
SET accepted_answer_id = $answer_id 
WHERE id = $question_id;
```

### 2. Proposed Indices

#### 2.1. Performance Indices

| **Index**         | IDX01                                                                                                                                           |
|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | questions                                                                                                                                       |
| **Attribute**     | user_id                                                                                                                                         |
| **Type**          | Hash                                                                                                                                            |
| **Cardinality**   | Medium                                                                                                                                          |
| **Clustering**    | No                                                                                                                                              |
| **Justification** | Table 'questions' is frequently accessed to obtain a user's questions. Filtering is done by exact match, thus an hash index type is best suited |
| SQL code          | `CREATE INDEX user_question ON "questions" USING hash (user_id);`                                                                               |

| **Index**         | IDX02                                                                                                                             |
|-------------------|-----------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | questions                                                                                                                         |
| **Attribute**     | created_at                                                                                                                        |
| **Type**          | B-Tree                                                                                                                            |
| **Cardinality**   | Medium                                                                                                                            |
| **Clustering**    | No                                                                                                                                |
| **Justification** | Table 'questions' is frequently accessed to obtain the newest questions. Sorting is useful so a b-tree index type is best suited. |
| SQL code          | `CREATE INDEX created_question ON "questions" USING btree (created_at);`                                                          |

| **Index**         | IDX03                                                                                                                                                                                                                                                   |
|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | questions                                                                                                                                                                                                                                               |
| **Attribute**     | updated_at                                                                                                                                                                                                                                              |
| **Type**          | B-Tree                                                                                                                                                                                                                                                  |
| **Cardinality**   | Medium                                                                                                                                                                                                                                                  |
| **Clustering**    | Yes                                                                                                                                                                                                                                                     |
| **Justification** | Table 'questions' is large. Sorting is made faster using a b-tree index type. From the three candidate indexes for clustering on table 'questions', updated_at is the most interesting since obtaining the most active questions is a frequent request. |
| SQL code          | <pre>CREATE INDEX updated_question ON "questions" USING btree (updated_at);<br/>CLUSTER "questions" USING updated_question;</pre>                                                                                                                       |

| **Index**         | IDX04                                                                                                                                                                                               |
|-------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | answers                                                                                                                                                                                             |
| **Attribute**     | created_at                                                                                                                                                                                          |
| **Type**          | B-Tree                                                                                                                                                                                              |
| **Cardinality**   | Medium                                                                                                                                                                                              |
| **Clustering**    | No                                                                                                                                                                                                  |
| **Justification** | Table 'answers' is frequently accessed with a variety of different filters. A b-tree index type is on created_at is useful to query a list of answers already sorted by the date they were created. |
| SQL code          | `CREATE INDEX created_answer ON "answers" USING btree (created_at);`                                                                                                                                |

| **Index**         | IDX05                                                                                                               |
|-------------------|---------------------------------------------------------------------------------------------------------------------|
| **Relation**      | answers                                                                                                             |
| **Attribute**     | user_id                                                                                                             |
| **Type**          | Hash                                                                                                                |
| **Cardinality**   | Medium                                                                                                              |
| **Clustering**    | No                                                                                                                  |
| **Justification** | Table 'answers' is accessed to query the answers of a specific user so a hash index type on user_id is appropriate. |
| SQL code          | `CREATE INDEX user_answer ON "answers" USING hash (user_id);`                                                       |

| **Index**         | IDX06                                                                                                                                                              |
|-------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | answers                                                                                                                                                            |
| **Attribute**     | question_id                                                                                                                                                        |
| **Type**          | B-Tree                                                                                                                                                             |
| **Cardinality**   | Medium                                                                                                                                                             |
| **Clustering**    | Yes                                                                                                                                                                |
| **Justification** | The most important and frequent query in the 'answers' table is to get the answers of a question so a clustered b-tree index type on question_id is a good option. |
| SQL code          | <pre>CREATE INDEX question_answer ON "answers" USING btree (question_id);<br/>CLUSTER "answers" USING question_answer;</pre>                                       |

| **Index**         | IDX07                                                                                                                 |
|-------------------|-----------------------------------------------------------------------------------------------------------------------|
| **Relation**      | comments                                                                                                              |
| **Attribute**     | user_id                                                                                                               |
| **Type**          | Hash                                                                                                                  |
| **Cardinality**   | Medium                                                                                                                |
| **Clustering**    | No                                                                                                                    |
| **Justification** | Table 'comments' is accessed to query the comments of a specific user so a hash index type on user_id is appropriate. |
| SQL code          | `CREATE INDEX user_comment ON "comments" USING hash (user_id);`                                                       |

| **Index**         | IDX08                                                                                                                |
|-------------------|----------------------------------------------------------------------------------------------------------------------|
| **Relation**      | comments                                                                                                             |
| **Attribute**     | question_id                                                                                                          |
| **Type**          | Hash                                                                                                                 |
| **Cardinality**   | Medium                                                                                                               |
| **Clustering**    | No                                                                                                                   |
| **Justification** | Table 'comments' is accessed to query the comments of a question so a hash index type on question_id is appropriate. |
| SQL code          | `CREATE INDEX question_comment ON "comments" USING hash (question_id);`                                              |

| **Index**         | IDX09                                                                                                            |
|-------------------|------------------------------------------------------------------------------------------------------------------|
| **Relation**      | comments                                                                                                         |
| **Attribute**     | answer_id                                                                                                        |
| **Type**          | Hash                                                                                                             |
| **Cardinality**   | Medium                                                                                                           |
| **Clustering**    | No                                                                                                               |
| **Justification** | Table 'comments' is accessed to query the comments of a answer so a hash index type on answer_id is appropriate. |
| SQL code          | `CREATE INDEX answer_comment ON "comments" USING hash (answer_id);`                                              |

| **Index**         | IDX10                                                                                                                                                  |
|-------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | comments                                                                                                                                               |
| **Attribute**     | created_at                                                                                                                                             |
| **Type**          | B-Tree                                                                                                                                                 |
| **Cardinality**   | Medium                                                                                                                                                 |
| **Clustering**    | Yes                                                                                                                                                    |
| **Justification** | The order of the comments is an important consideration when querying comments so a b-tree index type on created_at is a good candidate for clustering |
| SQL code          | <pre>CREATE INDEX created_comment ON "comments" USING btree (created_at);<br/>CLUSTER "comments" USING created_comment;</pre>                          |

| **Index**         | IDX11                                                                                                                                     |
|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | question_reviews                                                                                                                          |
| **Attribute**     | type                                                                                                                                      |
| **Type**          | Hash                                                                                                                                      |
| **Cardinality**   | Medium                                                                                                                                    |
| **Clustering**    | No                                                                                                                                        |
| **Justification** | Table 'question_reviews' is frequently accessed to count the likes or dislikes of a question so a hash index type on type is appropriate. |
| SQL code          | `CREATE INDEX type_question_review ON "question_reviews" USING hash (type);`                                                              |

| **Index**         | IDX12                                                                                                                                 |
|-------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | answer_reviews                                                                                                                        |
| **Attribute**     | type                                                                                                                                  |
| **Type**          | Hash                                                                                                                                  |
| **Cardinality**   | Medium                                                                                                                                |
| **Clustering**    | No                                                                                                                                    |
| **Justification** | Table 'answer_reviews' is frequently accessed to count the likes or dislikes of a answer so a hash index type on type is appropriate. |
| SQL code          | `CREATE INDEX type_answer_review ON "answer_reviews" USING hash (type);`                                                              |

| **Index**         | IDX13                                                                                                                                   |
|-------------------|-----------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | comment_reviews                                                                                                                         |
| **Attribute**     | type                                                                                                                                    |
| **Type**          | Hash                                                                                                                                    |
| **Cardinality**   | Medium                                                                                                                                  |
| **Clustering**    | No                                                                                                                                      |
| **Justification** | Table 'comment_reviews' is frequently accessed to count the likes or dislikes of a comment so a hash index type on type is appropriate. |
| SQL code          | `CREATE INDEX type_comment_review ON "comment_reviews" USING hash (type);`                                                              |


> Analysis of the impact of the performance indices on specific queries.
> Include the execution plan before and after the use of indices.

| **Query**                          | SELECT01                               |
|------------------------------------|----------------------------------------|
| **Description**                    | One sentence describing the query goal |
| `SQL code`                         ||
| **Execution Plan without indices** ||
| `Execution plan`                   ||
| **Execution Plan with indices**    ||
| `Execution plan`                   ||

#### 2.2. Full-text Search Indices

| **Index**         | IDX11                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
|-------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Relation**      | questions                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **Attributes**    | title, content                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| **Type**          | GIN                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Clustering**    | No                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| **Justification** | To provide full text search features for searching questions based on matching question titles or bodies (content).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| SQL code          | <pre>ALTER TABLE questions<br/>    ADD COLUMN ts_vectors TSVECTOR;<br/><br/>CREATE FUNCTION questions_search_update() RETURNS TRIGGER AS $$<br/>BEGIN<br/>    IF TG_OP = 'INSERT' THEN<br/>        NEW.ts_vectors = (<br/>                setweight(to_tsvector('english', NEW.title), 'A') &#124;&#124;<br/>                setweight(to_tsvector('english', NEW.content), 'B')<br/>            );    END IF;<br/><br/>    IF TG_OP = 'UPDATE' THEN<br/>        IF (NEW.title != OLD.title OR NEW.content != OLD.content) THEN<br/>            NEW.ts_vectors = (<br/>                    setweight(to_tsvector('english', NEW.title), 'A') &#124;&#124;<br/>                    setweight(to_tsvector('english', NEW.content), 'B')<br/>                );<br/>        END IF;<br/>    END IF;<br/><br/>    RETURN NEW;<br/>END $$<br/>LANGUAGE plpgsql;<br/><br/>CREATE TRIGGER questions_search_update<br/>    BEFORE INSERT OR UPDATE<br/>    ON questions<br/>    FOR EACH ROW<br/>EXECUTE PROCEDURE questions_search_update();<br/><br/>CREATE INDEX search_idx ON questions USING gin (ts_vectors);</pre> |

### 3. Triggers

| **Trigger**     | TRIGGER01                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
|-----------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Description** | The accepted answer of a question must belong to itself and not some other question                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
| SQL code        | <pre>CREATE FUNCTION check_accepted() RETURNS TRIGGER AS<br/>$BODY$<br/>BEGIN<br/>    IF NEW.accepted_answer_id IS NOT NULL AND<br/>       NOT EXISTS(SELECT * FROM answers WHERE id = NEW.accepted_answer_id AND question_id = NEW.id) THEN<br/>        RAISE EXCEPTION 'The answer (id: %) does not belong to this question (id: %)', NEW.accepted_answer_id, NEW.id;<br/>    END IF;<br/><br/>    RETURN NEW;<br/>END<br/>$BODY$<br/>    LANGUAGE plpgsql;<br/><br/>CREATE TRIGGER check_accepted<br/>    BEFORE INSERT OR UPDATE<br/>    ON questions<br/>    FOR EACH ROW<br/>EXECUTE PROCEDURE check_accepted();</pre> |

### 4. Transactions

> Transactions needed to assure the integrity of the data.  

| SQL Reference       | Transaction Name                    |
|---------------------|-------------------------------------|
| Justification       | Justification for the transaction.  |
| Isolation level     | Isolation level of the transaction. |
| `Complete SQL Code` ||

## Annex A. SQL Code


### A.1. Database schema

```sql
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

```

### A.2. Database population

```sql
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
```

---

## Revision history

Changes made to the first submission:

No changes were made yet.

---
GROUP2153, dd/mm/2021

- Fabio Huang, up201806829@g.uporto.pt
- Ivo Ribeiro, up201307718@g.uporto.pt
- Pedro Pacheco, up201806824@g.uporto.pt
- Vasco Soares Nogueira Garcia, up201805255@g.uporto.pt
