
## A4: Conceptual Data Model

The aim of this artifact is to provide a clear and concise representation of the project's entities and its associations, multiplicity and roles.
*TODO change/rewrite this*

### 1. Class diagram

*TODO needs updated picture*
![Figure 1: iNeedHelp conceptual data model in UML](https://git.fe.up.pt/lbaw/lbaw2122/lbaw2153/-/raw/main/img/datamodel.drawio.png)

### 2. Additional Business Rules

- BR01. A Comment belongs to a Question or Answer but not both

---

## A5: Relational Schema, validation and schema refinement

This artifact contains the Relational Schema obtained by mapping from the Conceptual Data Model. The Relational Schema includes each relation schema, attributes, domains, primary keys, foreign keys and other integrity rules to ensure data consistency and sanity
There are also some abbreviations and domains to aid with the compactness of the schema

### 1. Relational Schema

*TODO needs name changing*

Below is a textual table representation of the relational schemas

| Relation reference | Relation Compact Notation                                                                                                                                                                                                                                   |
|--------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| R01                | users(__id__, username NN UK, full_name, email email_t, password NN, status status_type NN, bio, location, profile_image_id -> images, is_blocked NN DF FALSE, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at) |
| R02                | moderators(__user_id__ -> users)                                                                                                                                                                                                                            |                                                                                                                                                                                                         |
| R03                | administrators(__user_id__ -> users)                                                                                                                                                                                                                        |
| R04                | questions(__id__ user_id -> users NN, title, content, views NN CK views >= 0, accepted_answer_id -> answers, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                        |
| R05                | tags(__id__, name NN)                                                                                                                                                                                                                                       |
| R06                | question_tags(__question_id__ -> questions, __tag_id__ -> tags)                                                                                                                                                                                             |
| R07                | answers(__id__, user_id -> users NN, question_id -> questions NN, content NN, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                                                       |
| R08                | comments(__id__, user_id -> users NN, question_id -> questions, answer_id -> answers, content NN, created_at timestamp_r, updated_at timestamp_r CK updated_at >= created_at)                                                                                   |
| R09                | badges(__id__, type badge_type NN, title NN, content NN, image_id -> images)                                                                                                                                                                                |
| R10                | user_badges(__user_id__ -> users, __badge_id__ -> badges, awarded_at timestamp_r)                                                                                                                                                                             |
| R11                | images(__id__, path NN UK)                                                                                                                                                                                                                                  |
| R12                | question_reviews(__user_id__ -> users, __question_id__ -> questions, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                              |
| R13                | answer_reviews(__user_id__ -> users, __answer_id__ -> answers, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                                    |
| R14                | comment_reviews(__user_id__ -> users, __comment_id__ -> comments, type vote_type NN, reviewed_at timestamp_r)                                                                                                                                                 |                                                                                                                                                                                                          |

### 2. Domains

Specification of additional domains:

| Domain Name | Domain Specification                               |
|-------------|----------------------------------------------------|
| email_t     | NOT NULL UNIQUE CHECK (email LIKE '_%@_%.__%')     |
| timestamp_t | TIMESTAMP NOT NULL DEFAULT NOW()                   |
| status_type | ENUM('active', 'inactive', 'idle', 'doNotDisturb') |
| badge_type  | ENUM('gold', 'silver', 'bronze')                   |
| vote_type   | ENUM('like', 'dislike')                            |


Legend:

- UK = UNIQUE KEY
- NN = NOT NULL
- DF = DEFAULT
- CK = CHECK

### 3. Schema validation

*TODO needs name changing and table number checking*

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **Table R01 {users}**        |                                                                                                                               |
|------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| **Keys:**                    | { userId }, { email }, { username }                                                                                           |
| **Functional Dependencies:** |                                                                                                                               |
| FD0101                       | userId → { full_name, username, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0102                       | username → { full_name, userId, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0103                       | email   → { full_name, userId, password, username, created_at, updated_at, is_blocked, status, bio, location, profile_image } |
| **NORMAL FORM**              | BCNF                                                                                                                          |

| **Table R02 {moderators}**   |             |
|------------------------------|-------------|
| **Keys:**                    | { user_id } |
| **Functional Dependencies:** | none        |
| **NORMAL FORM**              | BCNF        |

| **Table R03 {administrators}** |             |
|--------------------------------|-------------|
| **Keys:**                      | { user_id } |
| **Functional Dependencies:**   | none        |
| **NORMAL FORM**                | BCNF        |

[//]: # (TODO change upvotable)
| **Table R04 {questions}**    |                                                                        |
|------------------------------|------------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }, {acceptedAnswer}                                      |
| **Functional Dependencies:** |                                                                        |
| FD0901                       | { upvotableId } → {createdDate, title, content, views, acceptedAnswer} |
| FD0901                       | { acceptedAnswer } → {createdDate, title, content, views, upvotableId} |
| **NORMAL FORM**              | BCNF                                                                   |

| **Table R05 {tags}**         |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD1201                       | { id } → { name } |
| **NORMAL FORM**              | BCNF              |

| **Table R06 {question_tags}** |                         |
|-------------------------------|-------------------------|
| **Keys:**                     | { question_id, tag_id } |
| **Functional Dependencies:**  | none                    |
| **NORMAL FORM**               | BCNF                    |

| **Table R07 {answers}**      |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD1001                       | { upvotableId } → {upvotableId, userId, lastEditedDate, content } |
| **NORMAL FORM**              | BCNF                                                              |


| **Table R08 {comments}**     |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD1101                       | { upvotableId } → {userId, upvotableId, lastEditedDate, content } |
| **NORMAL FORM**              | BCNF                                                              |

| **Table R09 {badges}**       |                                                                     |
|------------------------------|---------------------------------------------------------------------|
| **Keys:**                    | { id }                                                              |
| **Functional Dependencies:** |                                                                     |
| FD1401                       | { id } → { type, receivedDate, title, content, userId, badgeImage } |
| **NORMAL FORM**              | BCNF                                                                |

| **Table R11 {images}**       |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD1501                       | { id } → { path } |
| **NORMAL FORM**              | BCNF              |

[//]: # (TODO new _review tables)
| **Table R05 {Upvotable}**    |                                     |
|------------------------------|-------------------------------------|
| **Keys:**                    | { upvotableId }                     |
| **Functional Dependencies:** |                                     |
| FD0801                       | { upvotableId } → {likes, dislikes} |
| **NORMAL FORM**              | BCNF                                |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  

---

## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload

| **Relation reference** | **Relation Name** | **Order of magnitude** | **Estimated growth** |
|------------------------|-------------------|------------------------|----------------------|
| R01                    | users             | thousands              | tens / day           |
| R02                    | moderators        | hundreds               | 0                    |
| R03                    | administrators    | dozens                 | 0                    |
| R04                    | questions         | thousands              | dozens / day         |
| R05                    | tags              | hundreds               | units / day          |
| R06                    | question_tags     | tens of thousands      | hundreds / day       |
| R07                    | answers           | tens of thousands      | hundreds / day       |
| R08                    | comments          | tens of thousands      | hundreds / day       |
| R09                    | badges            | dozens                 | 0                    |
| R10                    | user_badges       | hundreds               | units / day          |
| R11                    | images            | thousands              | dozens / day         |
| R12                    | question_reviews  | tens of thousands      | hundreds / day       |
| R13                    | answer_reviews    | tens of thousands      | hundreds / day       |
| R14                    | comment_reviews   | thousands              | dozens / day         |


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

> The database scripts are included in this annex to the EBD component.
>
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> This code should also be included in the group's git repository and links added here.

### A.1. Database schema

### A.2. Database population

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
