# ER: Requirements Specification Component
Project vision.

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
|  Administrator |  Authenticated user that is responsible for the management of users, questions, answers, topics, tags and badges. Has supervisory and moderation privileges |   
| Authenticated User  | Authenticated user that can access public information, post and answer questions, and manage their personal profile  |   
|  Moderator |  Authenticated user that belongs to the same location as the posted question or answer and can edit that same question or answer |   
|  Visitor |  Unauthenticated user that can register itself. Has access to public information and can perform searches |   
| OAuth API  |  External OAuth API that can be used to register or authenticate into the system |   



### User Stories

#### Visitor (Unauthenticated User)
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|
| US01  | Sign-in  |  high  |  As a Visitor, I want to authenticate into the system, so that I can access privileged information (post questions and answer questions)   | 
| US02 | Registration | high | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system and access futher features|
| US03 | Browse/Read | high| As a Visitor, I want to quickly navigate and browse the system without being forced to register or login to the system, so that I have the option to just quickly view the topic that interests m without wasting too much time
| US04 | OAuth API Sign-up | low | As a Visitor, I want to register a new account linked to my Google/Github account, so that I do not need to create a whole new account to use the platform
| US05 | OAuth API Sign-in | low | As a Visitor, I want to sign-in through my Google/Github account, so that I can authenticate myself into the system

#### Authenticated User
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|
| US11 | Change Password | high | As a User I want to be able to change my password when necessary
| US12 | Recover Password | medium | As a User, I want to safely recover my password, so that I can change my password for security reasons or in case of missplacement of previous password |
| US13 | Delete Account| medium | As a User, I want to safely delete my registered account, so that I can no longer share my personal data to the system|
| US14 | View Profile | medium | As a User I want to access my user profile page so I can see all my data and activity
| US15 | Edit Profile | medium | As a User I want to be able to edit my profile to my liking, including biography, profile picture and also manage private information

#### Reader
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|

#### Owner
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|
|--| Edit Question |--|--|
|--| Delete Question |--|--|
|--| Edit Answer |--|--|
|--| Delete Answer |--|--|
|--| Edit Comment |--|--|
|--| Delete Comment | -- | --|
| ---|---|---|---|

#### Administrator
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|
| FR041 | Administrator Accounts |---|---|
| FR042 | Administer User Accounts (search, view, edit, create) |---|---|
| FR043 | Block and Unblock User Accounts |---| As an Admin, I want to block and unblock user accounts to control their acess  |
| FR044 | Delete User Account |---| As an Admin, I want to delete user accounts, so that they are no longer visible |
| FR801 | Manage Tags|---|---|
| ---|---|---|---|

#### OAuth API
| Identifier  | Name  |  Priority  |  Description  | 
| ---|---|---|---|

#### 2.1. Actor 1
#### 2.2. Actor 2
#### 2.N. Actor n

### Supplementary Requirements

Section including business rules, technical requirements, and restrictions.
For each subsection, a table containing identifiers, names, and descriptions for each requirement.
#### 3.1. Business rules
#### 3.2. Technical requirements
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

