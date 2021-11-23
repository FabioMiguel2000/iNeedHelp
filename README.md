
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

| Relation reference | Relation Compact Notation                                                                                                                                            |
|--------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| R01                | user(__userId__ , full_name, username NN UK, password NN, email EmailType NN UK, created_at Now, updated_at Now CK updated_at >= created_at, is_blocked, status StatusType, bio, location, profile_image->Image) |
| R02                | author(__userId__ -> AuthenticatedUser)                                                                                                                              |
| R03                | moderator(__userId__ -> AuthenticatedUser)                                                                                                                           |
| R04                | administrator(__userId__ -> AuthenticatedUser)                                                                                                                       |
| R05                | post(__postId__, likes NN CK likes >= 0, dislikes NN CK >= 0, created_at Now, updated_at Now CK updated_at >= created_at,)                                                                                               |
| R06                | question(__postId__ -> Upvotable, content, views NN CK views >= 0, acceptedAnswerId -> Answer)                                            |
| R07                | answer(__postId__ -> Upvotable, questionId -> Question NN, userId -> Author NN, content NN)                                                |
| R08                | comment(__postId__ -> Upvotable, userId -> Author NN, answerId -> Answer, content NN)                                                    |
| R09                | user_badges(__userId__ -> User, __badgeId__ ->badge, awarded_at now)                                                                                                                                      |
| R10                | tag(__tagId__, name NN)                                                                                                                                              |
| R11                | question_tag(__upvotableId__ -> Question, __tagId__ -> Tag)                                                                                                          |
| R12                | badge(__badgeId__, type BadgeType, title NN, content NN, badgeImage -> image)|
| R13                | image(__id__, path NN)|
| R14                | like_dislike(__userId__ -> user, __postId__->post, type vote_type NN, review_date Now )                                                                                                                                               |

### 2. Domains

Specification of additional domains:

| Domain Name | Domain Specification                               |
|-------------|----------------------------------------------------|
| Now         | TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()     |
| status_type | ENUM('active', 'inactive', 'idle', 'doNotDisturb') |
| badge_type  | ENUM('goldBadge', 'silverBadge', 'bronzeBadge')    |
| email_type  | TEXT CHECK(VALUE LIKE '%@%.__%')                   |


Legend:

- UK = UNIQUE KEY
- NN = NOT NULL
- DF = DEFAULT
- CK = CHECK

### 3. Schema validation

*TODO needs name changing and table number checking*

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **Table R01 {User}**         |                                                                                                                               |
|------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| **Keys:**                    | { userId }, { email }, { username }                                                                                           |
| **Functional Dependencies:** |                                                                                                                               |
| FD0101                       | userId → { full_name, username, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0102                       | username → { full_name, userId, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image }   |
| FD0103                       | email   → { full_name, userId, password, username, created_at, updated_at, is_blocked, status, bio, location, profile_image } |
| **NORMAL FORM**              | BCNF                                                                                                                          |

| **Table R02 {Author}**       |            |
|------------------------------|------------|
| **Keys:**                    | { userId } |
| **Functional Dependencies:** | none       |
| **NORMAL FORM**              | BCNF       |

| **Table R03 {Moderator}**    |            |
|------------------------------|------------|
| **Keys:**                    | { userId } |
| **Functional Dependencies:** | none       |
| **NORMAL FORM**              | BCNF       |

| **Table R04 {Administrator}** |            |
|-------------------------------|------------|
| **Keys:**                     | { userId } |
| **Functional Dependencies:**  | none       |
| **NORMAL FORM**               | BCNF       |

| **Table R05 {Upvotable}**    |                                     |
|------------------------------|-------------------------------------|
| **Keys:**                    | { upvotableId }                     |
| **Functional Dependencies:** |                                     |
| FD0801                       | { upvotableId } → {likes, dislikes} |
| **NORMAL FORM**              | BCNF                                |

| **Table R06 {Question}**     |                                                                        |
|------------------------------|------------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }, {acceptedAnswer}                                      |
| **Functional Dependencies:** |                                                                        |
| FD0901                       | { upvotableId } → {createdDate, title, content, views, acceptedAnswer} |
| FD0901                       | { acceptedAnswer } → {createdDate, title, content, views, upvotableId} |
| **NORMAL FORM**              | BCNF                                                                   |

| **Table R07 {Answer}**       |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD1001                       | { upvotableId } → {upvotableId, userId, lastEditedDate, content } |
| **NORMAL FORM**              | BCNF                                                              |

| **Table R08 {Comment}**      |                                                                   |
|------------------------------|-------------------------------------------------------------------|
| **Keys:**                    | { upvotableId }                                                   |
| **Functional Dependencies:** |                                                                   |
| FD1101                       | { upvotableId } → {userId, upvotableId, lastEditedDate, content } |
| **NORMAL FORM**              | BCNF                                                              |

| **Table R09 {Tag}**          |                      |
|------------------------------|----------------------|
| **Keys:**                    | { tagId }            |
| **Functional Dependencies:** |                      |
| FD1201                       | { tagId } → { name } |
| **NORMAL FORM**              | BCNF                 |

| **Table R10 {Question_Tag}** |                      |
|------------------------------|----------------------|
| **Keys:**                    | { upvotable, tagId } |
| **Functional Dependencies:** | none                 |
| **NORMAL FORM**              | BCNF                 |

| **Table R11 {Badge}**        |                                                                     |
|------------------------------|---------------------------------------------------------------------|
| **Keys:**                    | { id }                                                              |
| **Functional Dependencies:** |                                                                     |
| FD1401                       | { id } → { type, receivedDate, title, content, userId, badgeImage } |
| **NORMAL FORM**              | BCNF                                                                |

| **Table R12 {Image}**        |                   |
|------------------------------|-------------------|
| **Keys:**                    | { id }            |
| **Functional Dependencies:** |                   |
| FD1501                       | { id } → { path } |
| **NORMAL FORM**              | BCNF              |


> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  

---

## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload

> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude** | **Estimated growth** |
|------------------------|-------------------|------------------------|----------------------|
| R01                    | Users             | thousands              | tens / day           |
| R02                    | Questions         | thousands              | tens / day           |
| R03                    | Answers           | tens of thousands      | hundreds / day       |
| R04                    | Comments          | tens of thousands      | hundreds / day       |
| R05                    | Badges            | tens                   | 0                    |
| R06                    | AwardedBadges     | hundreds               | units / day          |

### 2. Proposed Indices

#### 2.1. Performance Indices

> Indices proposed to improve performance of the identified queries.

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

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**         | IDX01                                |
|-------------------|--------------------------------------|
| **Relation**      | Relation where the index is applied  |
| **Attribute**     | Attribute where the index is applied |
| **Type**          | B-tree, Hash, GiST or GIN            |
| **Clustering**    | Clustering of the index              |
| **Justification** | Justification for the proposed index |
| `SQL code`        ||

### 3. Triggers

> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**     | TRIGGER01                                                               |
|-----------------|-------------------------------------------------------------------------|
| **Description** | Trigger description, including reference to the business rules involved |
| `SQL code`      ||

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
