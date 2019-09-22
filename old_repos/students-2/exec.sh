#!/bin/bash

# Make database migrations
echo "Create the Database Migrations"
python3 tanong_database/manage.py makemigrations

# Apply database migrations
echo "Apply database"
python3 tanong_database/manage.py migrate

echo "Run Fixtures"
python3 tanong_database/manage.py loaddata sections.yaml
python3 tanong_database/manage.py loaddata students.yaml
python3 tanong_database/manage.py loaddata grades.yaml

echo "Create superuser"
python tanong_database/manage.py shell << END
from django.contrib.auth import get_user_model
User = get_user_model()
if not User.objects.filter(email='admin@gmail.com'):
    User.objects.create_superuser('admin@gmail.com', 'database')
END

echo "Starting server"
python3 tanong_database/manage.py runserver 0.0.0.0:8000
