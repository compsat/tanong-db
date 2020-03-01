from django.db import models
from django.contrib.auth import get_user_model

User = get_user_model()

# Create your models here.
class Request(models.Model):
    user_access_ID= models.CharField(max_length=255)
    request_time = models.DateTimeField(max_length=100,auto_now_add=True)

class Adviser(models.Model):
    first_name = models.CharField(max_length=255)
    middle_name = models.CharField(max_length=255)
    last_name = models.CharField(max_length=255)
    user = models.OneToOneField(User, on_delete=models.CASCADE)

class SchoolYear(models.Model):
    years = models.CharField(max_length=5)

class Section(models.Model):
    year_level = models.IntegerField()
    name = models.CharField(max_length=255)
    Adviser = models.ManyToManyField(Adviser)
    schoolyear = models.ForeignKey(SchoolYear, on_delete=models.CASCADE,blank='false',null='false')

class Student(models.Model):
    first_name = models.CharField(max_length=255)
    middle_name = models.CharField(max_length=255)
    last_name = models.CharField(max_length=255)
    birthdate = models.DateField()
    sex_choices =[('MALE','male'),('FEMALE','female')]
    sex = models.CharField(max_length=10, choices=sex_choices,default='MALE')
    LRN = models.IntegerField(blank=True, null=True)

class Enrollment(models.Model):
    quarter = models.IntegerField()
    school_days = models.IntegerField()
    days_absent = models.IntegerField()
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE)
    section_id = models.ForeignKey(Section, on_delete=models.CASCADE)

class Subject(models.Model):
    name = models.CharField(max_length=255)
    subject_type = models.CharField(max_length=255)

class Grade(models.Model):
    student_id = models.ForeignKey(Student, on_delete=models.CASCADE)
    subject_id = models.ForeignKey(Subject, on_delete=models.CASCADE)
    numerical_grade = models.IntegerField()
    remark = models.CharField(max_length=100, blank='true',null='true')

class CoreValues(models.Model):
    behavior_statement = models.CharField(max_length=100)
    mark = models.CharField(max_length=50)
