# ER: Requirements Specification Component
The iNeedHelp project pretends to provide its users with a Q&A platform that helps them answer their questions in a complete, clean and easy to read way. Its users will be able to find multiple questions and answers along a variety of everyday and specific topics.

## A1: iNeedHelp

The iNeedHelp project is the development of a web-based information system for managing threads of questions and their respective answers, users and their information. This is a tool that can be used by anyone, but it is focused on students, teachers, investigators as well as all types of academics. A team of administrators is predefined, being them the maintainers and responsible persons for the system, ensuring it runs smoothly.

This application allows users to manage all their questions, answers as well as their personal information and awards for answering questions. A user can search a question by its title, topic or tag questions, answers, and user information will be available worldwide virtually, except the personal information of a user, which only the user and administrators will have access to. Questions are accessible to unregistered users, but to answer and post a question the user needs to be registered.

Users will be separated into groups with different permissions. These groups include the above-mentioned administrators, with complete access and modification privileges, and the registered users, with privileges to ask, answer, comment, vote and report a question, view and edit their profile and highlight their awards. By answering questions users can receive an award for their answer and the most upvoted answer will be highlighted on the question thread.

The platform will have an adaptive and responsive design, allowing users to have a clear browsing experience, regardless of the device (desktop, tablet or smartphone). The product will also provide easy navigation and a joyful overall user experience.

---
## A2: Actors and User stories
This artifact contains the specifications of the actors involved and their user stories, serving as an agile documentation for the iNeedHelp project development.

### Actors

![](./img/actorDiagram.drawio.png)

| Identifier  | Description  | 
|---|---|
| User  |  Generic user that has access to public information, such as questions and answers, and can search topics and tags
|  Visitor |  Unauthenticated user that can register itself. Has access to public information and can perform searches
| Authenticated User  | Authenticated user that can access public information, post and answer questions, and manage their personal profile  |   
|  Administrator |  Authenticated user that is responsible for the management of users, questions, answers, topics, tags and badges. Has supervisory and moderation privileges |   
|  Moderator |  Authenticated user that belongs to the same location as the posted question or answer and can edit that same question or answer |      
| OAuth API  |  External OAuth API that can be used to register or authenticate into the system |   



## User Stories

#### Visitor (Unauthenticated User)
| Identifier  | Name  |  Priority  |  Description
|---|---|---|---|
| US01  | Sign-in  |  high  |  As a Visitor, I want to authenticate into the system, so that I can access privileged information (post questions and answer questions)   | 
| US02 | Registration | high | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system and access further features|
| US03 | Browse/Read | high| As a Visitor, I want to quickly navigate and browse the system without being forced to register or login to the system, so that I have the option to just quickly view the topic that interests m without wasting too much time
| US04 | OAuth API Sign-up | low | As a Visitor, I want to register a new account linked to my Google/Github account, so that I do not need to create a whole new account to use the platform
| US05 | OAuth API Sign-in | low | As a Visitor, I want to sign-in through my Google/Github account, so that I can authenticate myself into the system

#### Authenticated User
| Identifier | Name | Priority | Description
|---|---|---|---|
| US11 | Change Password | high | As a User I want to be able to change my password when necessary
| US12 | Recover Password | medium | As a User, I want to safely recover my password, so that I can change my password for security reasons or in case of misplacement of previous password
| US13 | Delete Account| medium | As a User, I want to safely delete my registered account, so that I can delete my personal data from the website
| US14 | View Profile | medium | As a User I want to access my user profile page so I can see all my data and activity
| US15 | Edit Profile | medium | As a User I want to be able to edit my profile to my liking, including biography, profile picture and also manage private information

#### Moderator
| Identifier  | Name  |  Priority  |  Description
|---|---|---|---|
| US21 | Mark as duplicate | medium | As a Moderator I want to be able to mark questions as duplicates and link to the question it duplicates
| US22 | Edit Questions | high | As a Moderator I want to be able to remove anyone's content as I deem necessary to prevent language abuse or other inappropriate behavior
| US23 | Edit Content | medium | As a Moderator I want to be able to edit anyone's questions/responses to fix typos or make them clearer 
| US24 | Edit Question Tags | high | As a Moderator I want to be able to edit the tags of any question
| US25 | Lock Question | low | As a Moderator I want to be able to lock the discution of any question, preventing edition from regular users

#### { Question, Answer, Comment } Author
| Identifier  | Name  |  Priority  |  Description
|---|---|---|---|
| US31 | Edit Question | high | As an Author I want to be able to edit my questions/answers/comments
| US32 | Delete Question | high | As an Author I want to be able to delete my questions/answers/comments

#### Question Author
| Identifier  | Name  |  Priority  |  Description
|---|---|---|---|
| US41 | Edit Question Tags | high | As a Question Author I want to be able to edit the tags of the question
| US42 | Mark Answer as Correct | high | As a Question Author I want to be able to mark an answer as correct

#### Administrator
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|
| US41 | Administrator Accounts |---|---|
| US42 | Administer User Accounts (search, view, edit, create) |---|---|
| US43 | Block/Unblock User Accounts |---| As an Admin, I want to block and unblock user accounts to control their access |
| US44 | Delete User Account |---| As an Admin, I want to delete user accounts, so that they are no longer visible |
| US45 | Manage Tags|---| As a Manager I want  to be able to manage question's tags |

### Supplementary Requirements

Section including business rules, technical requirements, and restrictions.
For each subsection, a table containing identifiers, names, and descriptions for each requirement.
#### 3.1. Business rules

| Identifier  | Name  |  Description  | 
| --- | --- | --- |
| BR01 | Deleted Account | Upon account deletion (US13), shared user data (e.g. comments, reviews, likes) is kept but is made anonymous |
| BR11 | --- | Administrators are participating members of the community, i.e. can post or vote on questions or answers |
| BR12 | --- | Questions and answers edited after being posted should have a clear indication of the editions |
| BR13 | --- | User badges are dependent on the likes and dislikes received on his questions and answers, and also on actions made by the user (first question, first answer, etc) |


#### 3.2. Technical requirements

| Identifier  | Name  |  Description  | 
| --- | --- | --- |
| TR01 | Performance | The system should have response times shorter than 2s to ensure the user's attention |
| TR02 | Robustness | The system must be prepared to handle and continue operating when runtime errors |
| TR03 | Scalability | The system must be prepared to deal with the growth in the number of users and their actions  |
| TR04 | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use |
| --- | --- | --- |

#### 3.3. Restrictions

---
## A3: Information Architecture
Brief presentation of the artefact goals.

### Sitemap

Sitemap presenting the overall structure of the web application.
Each page must be identified in the sitemap.
Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.

### Wireframes

Wireframes for, at least, two main pages of the web application.
Do not include trivial use cases.
UIxx: Page Name
UIxx: Page Name

### Revision history
Changes made to the first submission:
Item 1

---
GROUP2153, 26/10/2021

- Ivo Ribeiro, up201307718@g.uporto.pt
- Pedro Pacheco, up201806824@g.uporto.pt
- Vasco Soares Nogueira Garcia, up201805255@g.uporto.pt
- Fabio Huang, up201806829@g.uporto.pt

