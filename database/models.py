from django.db import models

# Create your models here.
class Request(models.Model):
    request_ID = models.IntegerField(max_length=50)
    user_access_ID= models.CharField(max_length=250)
    request_time = models.DateTimeField(max_length=100)

class User(models.Model):
    user_id = models.IntegerField(max_length=50)
    email = models.EmailField(max_length=100)
    password = models.CharField(max_length=250)
    user_type = models.CharField(max_length=20)

class Adviser(models.Model):
    adviser_id = models.IntegerField(max_length=50)
    full_name = models.CharField(max_length=250)
    email_address = models.EmailField(max_length=100)
    password = models.CharField(max_length=250)

class Section(models.Model):
    section_id = models.IntegerField(max_length=50)
    year_level = models.CharField(max_length=10)
    name = models.CharField(max_length=20)

class Schoolyear(models.Model):
    schoolyear_id = models.IntegerField(max_length=50)
    years = models.CharField(max_length=10)

class Student(models.Model):
    student_id = models.IntegerField(max_length=10)
    full_name = models.CharField(max_length=250)
    birthdate = models.DateTimeField()
    sex = models.CharField(max_length=10)
    LRN = models.IntegerField(max_length=10, blank='true', null='true')
    age = models.IntegerField(max_length=3)

class Enrollment(models.Model):
    enrollment_id = models.IntegerField(max_length=100)
    quarter = models.IntegerField(max_length=1)
    school_days = models.IntegerField(max_length=3)
    days_absent = models.IntegerField(max_length=3)
    days_present = models.IntegerField(max_length=3)
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE, blank='false', null="false")
    section_id = models.ForeignKey(Section, on_delete=models.CASCADE, blank='false', null="false")

class Grade(models.Model):
    grade_id = models.IntegerField(max_length=10)
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE, blank='false', null='false')
    subject_id = models.ForeignKey(subject, on_delete=models.CASCADE, blank='false', null='false')
    remark = models.CharField(max_length=250,blank='true',null='true')

class Subject(models.Model):
    subject_id = models.IntegerField(max_length=10)
    name = models.CharField(max_length=50)
    subject_type = models.CharField(max_length=10)

class CoreValues(models.Model):
    corevalue_id = models.IntegerField(max_length=10)
    behavior_statement = models.CharField(max_length=300)
    mark = models.CharField(max_length=2)
