# CS122 Project
###### CRUD STUDENTS
The student records system contains records of all the registered students under Tañong Public High School. This system allows administrators to create, read, update, and delete student records, sections, and school years. The student records are stored in this database system, and student records may be sorted by their last name, their graduation year, and their section. It may also filter the data so that only certain year levels, sections, or graduation years are being viewed.

---------

###### SUPERUSER CREDENTIALS
**username:** studentrecords

**password:** stud3ntr3cordz

###### INSTALLS
- django
- django-widget-tweaks
- mysqlclient

###### RUNNING THE SERVER LOCALLY
1. Make sure you installed everything listed in Installs.
2. In the main folder, open the terminal and run `python manage.py migrate`.
3. Run `python manage.py makemigrations`
4. Run `python manage.py migrate` again.
4. Run `python manage.py runserver`.to run the server.
4. Go to your browser and visit `127.0.0.1:8000/studentdb/`.