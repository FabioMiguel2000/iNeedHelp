# iNeedHelp

The iNeedHelp project provides its users with a Q&A platform that helps them answer their questions in a complete, clean, and easy to read way. Its users are able to find multiple questions and answers along with a variety of everyday and specific topics.


<table>
   <tr>
    <th>Home Page</th>
    <th><img src="https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/iNeedHelp-HomePage.png" alt="HomePage"></th>
  </tr>
  <tr>
    <th>Login Page</th>
    <th><img src="https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/iNeedHelp-Login.png" alt="LoginPage"></th>
  </tr>
    <tr>
    <th>Question Page</th>
    <th><img src="https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/iNeedHelp-Question.png" alt="QuestionPage"></th>
  </tr>
      <tr>
    <th>Create Question Page</th>
    <th><img src="https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/iNeedHelp-CreateQuestion.png" alt="CreateQuestionPage"></th>
  </tr>
</table>


## **Installing the Software Dependencies**

Link to the release with the final version of the source code in the group's Git repository: https://github.com/FabioMiguel2000/iNeedHelp

To prepare you computer for development you need to install some software, namely PHP and the PHP package manager Composer.

We recommend using an **Ubuntu** distribution that ships PHP 8.0 (e.g Ubuntu 21.10). You may install the required software with:

```bash
sudo apt install git composer php8.0 php8.0-mbstring php8.0-xml php8.0-pgsql
```

The following links provide instructions for installing [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/install/)

### Local Setup

1. Clone the repository

```bash
git clone https://github.com/FabioMiguel2000/iNeedHelp.git
```

2. Head inside the project directory, and install the composer dependencies:

```bash
cd iNeedHelp/
composer install
```

3. Change the filename of `.env_local` to `.env` (this will overwrite the current `.env` file)
4. There is a docker-compose file that sets up PostgresSQL and PgAdmin4, run:

```bash
docker-compose up -d
```

5. Populate the database with seed, run:

```bash
php artisan db:seed
```

6. And finally, run the web server locally with:

```bash
php artisan serve
```
## **Usage**


#### Administration Credentials

| Username | Password |
| -------- | -------- |
| admin    | admin    |

#### User Credentials


| Type          | Username  | Password |
| ------------- | --------- | -------- |
| basic account | inspectora  | 123123 |
| basic account | sanchovies  | 123123 |
| Moderator     | JDean72 | jd72olaola |

## **Application Help**

User assistence is provided in various ways such as:
- Automaticaly redirecting to login page when performing an action that needs authentication as a visitor
- Notifications when creating comments or answers


![Figure 1.1 - App Help 1](https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/pa-appHelp1.png)

- Labels and hints on textboxs, which help users fill them

![Figure 1.2 - App Help 2](https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/pa-appHelp2.png)

- Video Presentation

[![iNeedHelp-VideoPresentation](https://github.com/FabioMiguel2000/iNeedHelp/blob/main/img/lbaw2153.png)](https://m.youtube.com/watch?v=kaWj4leklGo)

## **Team Members**

* Fabio Huang, [up201806829@g.uporto.pt](mailto:up201806829@g.uporto.pt) 
* Ivo Ribeiro, [up201307718@g.uporto.pt](mailto:up201307718@g.uporto.pt) 
* Pedro Pacheco, [up201806824@g.uporto.pt](mailto:up201806824@g.uporto.pt)
* Vasco Garcia, [up201805255@g.uporto.pt](mailto:up201805255@g.uporto.pt)
