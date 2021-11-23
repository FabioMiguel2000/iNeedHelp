
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

| Relation reference | Relation Compact Notation |
| ------------------ | ------------------------- |
| R01                | user(__userId__ , fullname, username NN UK, password NN, email EmailType NN UK, registerDate Now,  isBlocked, status StatusType, bio, location, profileImage->Image) |
| R03                | user_badges(__userId__ -> User) |
| R04                | author(__userId__ -> AuthenticatedUser) |
| R05                | moderator(__userId__ -> AuthenticatedUser) |
| R06                | administrator(__userId__ -> AuthenticatedUser) |
| R08                | pvotable(__upvotableId__, likes NN CK likes >= 0, dislikes NN CK >= 0) |
| R09                | question(__upvotableId__ -> Upvotable, createdDate Now, title, content, views NN CK views >= 0, acceptedAnswer -> Answer) |
| R10                | answer(__upvotableId__ -> Upvotable, upvotableId -> Question NN, userId -> Author NN, lastEditedDate Now, content NN) |
| R11                | comment(__upvotableId__ -> Upvotable, userId -> Author NN, upvotableId -> Answer, content NN, lastEditedDate Now) |
| R12                | tag(__tagId__, name NN) |
| R13                | question_tag(__upvotableId__ -> Question, __tagId__ -> Tag) |
| R14                | badge(__id__, type BadgeType, receivedDate Now, title NN, content NN, userId -> AuthenticatedUser, badgeImage -> image) |
| R15                | image(__id__, path NN) |

### 2. Domains

Specification of additional domains:

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Now         | TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() |
| status_type  | ENUM('active', 'inactive', 'idle', 'doNotDisturb')|
| badge_type   | ENUM('goldBadge', 'silverBadge', 'bronzeBadge')|
| email_type   | TEXT CHECK(VALUE LIKE '%@%.__%') |


Legend:

- UK = UNIQUE KEY
- NN = NOT NULL
- DF = DEFAULT
- CK = CHECK

### 3. Schema validation

*TODO needs name changing and table number checking*

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **Table R01 {User}** |             |
| --------------  | ---                |
| **Keys:** | { userId }, { email }, { username }      |
| **Functional Dependencies:** |       |
| FD0101          | userId → { full_name, username, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image } |
| FD0102          | username → { full_name, userId, password, email, created_at, updated_at, is_blocked, status, bio, location, profile_image } |
| FD0103          | email   → { full_name, userId, password, username, created_at, updated_at, is_blocked, status, bio, location, profile_image }|
| **NORMAL FORM** | BCNF               |

| **Table R02 {Author}**   |               |
| --------------  | ---                |
| **Keys:** |{ userId }           |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

| **Table R03 {Moderator}**   |               |
| --------------  | ---                |
| **Keys:** |{ userId }           |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

| **Table R04 {Administrator}**   |               |
| --------------  | ---           |
| **Keys:** |{ userId }           |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

| **Table R05 {Upvotable}**   |               |
| --------------  | ---           |
| **Keys:** |{ upvotableId }           |
| **Functional Dependencies:** |       |
| FD0801          | { upvotableId } → {likes, dislikes}  |
| **NORMAL FORM** | BCNF              |

| **Table R06 {Question}**   |               |
| --------------  | ---           |
| **Keys:** |{ upvotableId }, {acceptedAnswer}         |
| **Functional Dependencies:** |       |
| FD0901          | { upvotableId } → {createdDate, title, content, views, acceptedAnswer}  |
| FD0901          | { acceptedAnswer } → {createdDate, title, content, views, upvotableId}  |
| **NORMAL FORM** | BCNF              |

| **Table R07 {Answer}**   |               |
| --------------  | ---           |
| **Keys:** |{ upvotableId }        |
| **Functional Dependencies:** |      |
| FD1001          | { upvotableId } → {upvotableId, userId, lastEditedDate, content }  |
| **NORMAL FORM** | BCNF              |

| **Table R08 {Comment}**   |               |
| --------------  | ---           |
| **Keys:** |{ upvotableId }        |
| **Functional Dependencies:** |       |
| FD1101          | { upvotableId } → {userId, upvotableId, lastEditedDate, content }  |
| **NORMAL FORM** | BCNF              |

| **Table R09 {Tag}**   |               |
| --------------  | ---           |
| **Keys:** |{ tagId }        |
| **Functional Dependencies:** |       |
| FD1201          | { tagId } → { name }  |
| **NORMAL FORM** | BCNF              |

| **Table R10 {Question_Tag}**   |               |
| --------------  | ---           |
| **Keys:** |{ upvotable, tagId }       |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF              |

| **Table R11 {Badge}**   |               |
| --------------  | ---           |
| **Keys:** |{ id }        |
| **Functional Dependencies:** |       |
| FD1401          | { id } → { type, receivedDate, title, content, userId, badgeImage }  |
| **NORMAL FORM** | BCNF              |

| **Table R12 {Image}**   |               |
| --------------  | ---           |
| **Keys:** |{ id }        |
| **Functional Dependencies:** |       |
| FD1501          | { id } → { path }  |
| **NORMAL FORM** | BCNF              |


> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  

---

## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload

> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | Users        | thousands | tens / day |
| R02                | Questions    | thousands | tens / day |
| R03                | Answers      | tens of thousands | hundrends / day |
| R04                | Comments     | tens of thousands | hundrends / day |
| R05                | Badges       | tens | 0
| R06                | AwardedBadges| hundreds | units / day

### 2. Proposed Indices

#### 2.1. Performance Indices

> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | R0    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||

> Analysis of the impact of the performance indices on specific queries.
> Include the execution plan before and after the use of indices.

| **Query**       | SELECT01                               |
| ---             | ---                                    |
| **Description** | One sentence describing the query goal |
| `SQL code`                                              ||
| **Execution Plan without indices**                      ||
| `Execution plan`                                        ||
| **Execution Plan with indices**                         ||
| `Execution plan`                                        ||

#### 2.2. Full-text Search Indices

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||

### 3. Triggers

> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Trigger description, including reference to the business rules involved |
| `SQL code`                                             ||

### 4. Transactions

> Transactions needed to assure the integrity of the data.  

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   ||

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
