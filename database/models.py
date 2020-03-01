from django.db import models
from django.contrib.auth import get_user_model
User = get_user_model()

# Create your models here.
class Request(models.Model):
    user_access_ID= models.CharField()
    request_time = models.DateTimeField(max_length=100,auto_now_add=True)

class User(models.User):
    # email = models.EmailField(max_length=100)
    # password = models.CharField()
    user_type = models.CharField()

class Adviser(models.User):
    first_name = models.CharField()
    middle_name = models.CharField()
    last_name = models.CharField()
    User=models.OnetoOneField(User)

class Section(models.Model):
    year_level = models.IntegerField(max_length=5)
    name = models.CharField()
    Adviser = models.ManytoManyField(Adviser)
    schoolyear = models.ForeignKey(SchoolYear, on_delete=models.CASCADE,blank='false',null='false')

class SchoolYear(models.Model):
    years = models.CharField()

class Student(models.Model):
    first_name = models.CharField()
    middle_name = models.CharField()
    last_name = models.CharField()
    birthdate = models.DateField()
    sex_choices =[(MALE,'male'),(FEMALE,'female')]
    sex = models.CharField(choices=gender_choices,default=null)
    LRN = models.IntegerField(max_length=10, blank=True, null=True)

class Enrollment(models.Model):
    quarter = models.IntegerField(max_length=1)
    school_days = models.IntegerField(max_length=3)
    days_absent = models.IntegerField(max_length=3)
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE)
    section_id = models.ForeignKey(Section, on_delete=models.CASCADE)

class Grade(models.Model):
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE)
    subject_id = models.ForeignKey(Subject, on_delete=models.CASCADE)
    numerical_grade = models.IntegerField()
    remark = models.CharField(blank='true',null='true')

class Subject(models.Model):
    name = models.CharField()
    subject_type = models.CharField()

class CoreValues(models.Model):
    behavior_statement = models.CharField()
    mark = models.CharField()
