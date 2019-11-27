# Tanong High School Student Database

A website will be made using **Django** in order to aid the administration in keeping track of the records of all the current students at Tanong Junior High School. Since the high school mainly uses physical records to fetch data about certain students, they said that even just a digital database would help immensely the registrar, especially considering that they only have one registrar whom we interviewed. This would help with automatically filling out the necessary forms mandated by the DepEd from the public schools, such as the SF10, which they spend countless time on just because of the difficulty of using physical records. With this website, the registrar and advisers can easily access student records and add more records if needed, and the data can be preserved and stored better as compared to physical records, which they mentioned are already crumbling.

Only advisers and the registrar can have accounts and use our website. They can add and access records of the students with the necessary information to fill out the forms.

**To set up the Django project after cloning this repo, please install MySQL on your computers and proceed to the virtualenv section of this README first before anything. For the MySQL installation, look it up on the [website](https://dev.mysql.com/)**

## Important Links
- [Google Drive Link](https://drive.google.com/open?id=1_2JE13FPKtW6TRHM6Ya4zerJDHfe8Nws)
- [Django Docs](https://docs.djangoproject.com/en/2.2/intro/tutorial01/)
- [Sample Django Project](https://github.com/yellowanthq/yellowant-sample-django-app)

## Initial Set-up

The .env file sent to you MUST BE PRESENT in the project root folder (i.e. the same folder as the manage.py). Without this .env, the website will return some errors when you try to run the server.

Whenever you run manage.py commands, remember also that your virtual environment must be activated. Read more about virtual environments below.

## Commands to Remember
### virtualenv
[Read more about python virtual environments here](https://www.geeksforgeeks.org/python-virtual-environment/)

A virtual environment is a tool that helps to keep dependencies required by different projects separate by creating isolated python virtual environments for them.

What are the commands you need to remember?
```
python -m venv ~/.virtualenvs/tanongdb
```
This creates a virtual environment named tanongdb in a folder entitled .virtualenvs. 

```
source ~/.virtualenvs/tanongdb/bin/activate
```
This activates your virtualenv in your Terminal window, which means you can now use the dependencies installed in your venv.

```
pip install -r requirements.txt
```
Installs all the dependencies listed in the requirements.txt of this repo to your virtualenv. Make sure your Terminal is at the same directory as the requirements.txt. **This command should be done when setting up the Django project.**

```
pip install [package_name]
```
If you find an external Python library which you think you can use for this project, you can install it in your virtualenv using this command. Don't forget to add the library and the version you installed to the requirements.txt so that other collaborators can also install the dependency in their virtualenvs.

### Postgres

Make sure that you've already installed Postgres on your computer. The Postgres details (username, password, database name, etc.) is found in the .env file, so your Postgres configuration MUST match the ones found in the .env. That means that the username, password and database name you create must be the same as the ones in the .env file. To configure your Postgres, follow the instructions in this [website](https://www.a2hosting.com/kb/developer-corner/postgresql/managing-postgresql-databases-and-users-from-the-command-line). Here's a summary of the steps:

Creating a Postgres user
1. `createuser --interactive --pwprompt` - creates a user with prompt
2. At the "Enter name of role to add:" prompt, type the user's name.
3. At the "Enter password for new role:" prompt, type a password for the user.
4. At the "Enter it again:" prompt, retype the password.
5. At the "Shall the new role be a superuser?" prompt, type y to grant superuser access.
6. At the "Shall the new role be allowed to create databases?" prompt, type y to grant database creation access.
7. At the "Shall the new role be allowed to create more new roles?" prompt, type y to grant role creation access.

Creating a Postgres database
1. `createdb -O [USER_NAME] [DB_NAME]` - creates a database. Make sure to replace the `[USER_NAME]` and `[DB_NAME]` with your username and database name, respectively.
2. Run `psql -U [USER_NAME] [DB_NAME]` to run your Postgres shell as the user you created.
3. `GRANT ALL ON DATABASE [DB_NAME] TO [USER_NAME];` - makes sure that your user has permissions to do any action to the database.

### Github Workflow
[Very helpful interactive tutorial on the Git workflow](https://learngitbranching.js.org/)

1. Before creating a new branch from master on your local repo, make sure that you're working with the latest version of the branch. To do that, check first if you're on the master branch using ```git branch```. If you're not, you can switch to the master branch using ```git checkout master```. Then, run ```git pull```, which fetches the updated commits from the remote repo and updates your local repo accordingly.
2. Create a new branch from the master branch. You can create a branch on the remote repo (Github website) or on the local  repo (on your computer); just make sure you're branching off the master branch. To do this locally, run ```git checkout -b branch_name```.
3. Make changes to your code.
4. Run ```git status``` to see what files have been changed. To add a specific file to the stage before committing, run ```git add [path_to_file]```. To add all the changed files to the stage, run ```git add . ```.
5. After adding files to the stage, you can now commit your changes using ```git commit -m "Commit message"```.
**It is bad practice to have ALL your big changes in just one commit. Better to get used to have a purpose for each commit.** i.e. Adding only some files for a commit, then adding the other changed files for another commit, kind of like categorizing your changes.
6. Now that you've committed on your local repo, you can now push them to the remote repo using ```git push```. You can view previous commits on the branch using ```git log```.
7. After you've made all your changes on your branch, make a pull request on the Github website, attempting to merge it with the master branch.

Important commands:
```
git branch
git checkout [branch_name]
git checkout -b [new_branch]
git pull
git status
git add
git commit -m "Commit message"
git push
git log
```

### Django Commands
Please read the Django tutorials in their official docs to fully understand these commands.

```
python manage.py runserver
```
 - runs the web server (only for development)
 - to change the port: python manage.py runserver [port_number]
 - to change server’s IP: python manage.py runserver [ip]:[port]

```
python manage.py startapp [app_name]
```
 - creates an app

```
python manage.py makemigrations
```
 - adds the changes made into the database

```
python manage.py migrate
```
 - applies the changes to the database

```
python manage.py sqlmigrate [app_name] 0001
```
 - takes migration names and returns their SQL

```
python manage.py check
```
 - checks for any problems in your project without making migrations or touching the database

```
python manage.py shell
```
 - invokes the python shell
 
```
python manage.py createsuperuser
```
 - creates a user who can login to the admin site


#### In the shell:
```
from [app_name].models import [model_name]
```
 - import the model in the shell

```
[model_name].objects.all()
```
 - displays all the objects in the database

```
v = [model_name]([field_name] = [value], …)
```
 - create an object in the database

```
v.save()
```
 - saves the object into the database

```
v.id
```
 - gets the ID

```
[model_name].objects.get(pk=1)
```
 - gets the object with primary key 1

```
v.[field_name]_set.all()
```
 - displays any choices from the related object set

```
v.[field_name]_set.create(parameters…)
```
 - creates objects and adds to the related set

### PostgreSQL
```
psql -U [USER_NAME] [DB_NAME]
```
 - logs in your postgres user and in your database

#### In the PostgreSQL shell:
```
DROP DATABASE tanong_db;
```
 - deletes the database named tanong_db

```
CREATE DATABASE tanong_db;
```
 - creates database named tanong_db

**Note that the username and password of your PostgreSQL configuration, as well as the name of the database you made, must match the ones in the .env file.**
