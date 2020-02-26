from django.db import models

class Student(models.Model):
    student_id = models.IntegerField(primary_key=True)
    student_first_name = models.CharField(max_length=255)
    student_middle_name = models.CharField(max_length=255)
    student_last_name = models.CharField(max_length=255)
    student_birthdate = models.DateTimeField()
    student_age = models.IntegerField()
    student_deped_lrd = models.IntegerField()
    # INSERT FOREIGN KEY SECTION ID

class Enrollment(models.Model):
    enrollment_id = models.IntegerField(primary_key=True)
    # INSERT FOREIGN KEY SCHOOL YEAR
    enrollment_quarter = models.IntegerField()
    enrollment_yearlevel = models.IntegerField()
    enrollment_section = models.CharField(max_length=4)
    enrollment_attendance = models.IntegerField()

class SchoolYear(models.Model):
    schoolyear_schooldays = models.IntegerField()
    schoolyear_schoolyears = models.IntegerField()

# class CoreValues(models.Model):


class Grade(models.Model):
    grade_gradeid = models.IntegerField(primary_key=True)
    # INSERT FOREIGN KEY SUBJECT ID

class Subject(models.Model):
    subject_subjectid = models.IntegerField(primary_key=True)
    subject_name = models.CharField(max_length=4)

class StudentsBehavior(models.Model):
    behavior_statement = models.CharField(max_length=4)
    behavior_quarter = models.IntegerField()

class RemedialClasses(models.Model):
    remedial_id = models.IntegerField(primary_key=True)
    remedial_learningarea = models.IntegerField()
    remedial_classmark = models.IntegerField()
    remedial_finalgrade = models.IntegerField()
    remedial_remarks = models.CharField(max_length=4)
    remedial_startdate = models.IntegerField()
    remedial_enddate = models.IntegerField()

class Attendance(models.Model):
    attendance_id = models.IntegerField(primary_key=True)
    attendance_schooldays = models.IntegerField()
    attendance_absentdays = models.IntegerField()
    attendance_presentdays = models.IntegerField()

# MORGAN
# class Request(models.Model):
#     request_ID = models.IntegerField(max_length=50)
#     user_access_ID= models.CharField(max_length=250)
#     request_time = models.DateTimeField(max_length=100)

# class User(models.Model):
#     user_id = models.IntegerField(max_length=50)
#     email = models.EmailField(max_length=100)
#     password = models.CharField(max_length=250)
#     user_type = models.CharField(max_length=20)

# class Adviser(models.Model):
#     adviser_id = models.IntegerField(max_length=50)
#     full_name = models.CharField(max_length=250)
#     email_address = models.EmailField(max_length=100)
#     password = models.CharField(max_length=250)

# class Section(models.Model):
#     section_id = models.IntegerField(max_length=50)
#     year_level = models.CharField(max_length=10)
#     name = models.CharField(max_length=20)

# class Schoolyear(models.Model):
#     schoolyear_id = models.IntegerField(max_length=50)
#     years = models.CharField(max_length=10)

# class Student(models.Model):
#     student_id = models.IntegerField(max_length=10)
#     full_name = models.CharField(max_length=250)
#     birthdate = models.DateTimeField()
#     sex = models.CharField(max_length=10)
#     LRN = models.IntegerField(max_length=10, blank='true', null='true')
#     age = models.IntegerField(max_length=3)

# class Enrollment(models.Model):
#     enrollment_id = models.IntegerField(max_length=100)
#     quarter = models.IntegerField(max_length=1)
#     school_days = models.IntegerField(max_length=3)
#     days_absent = models.IntegerField(max_length=3)
#     days_present = models.IntegerField(max_length=3)
#     student_id = models.ForeignKey(Student, on_delete=models.CASCADE, blank='false', null="false")
#     section_id = models.ForeignKey(Section, on_delete=models.CASCADE, blank='false', null="false")

# class Grade(models.Model):
#     grade_id = models.IntegerField(max_length=10)
#     student_id = models.ForeignKey(Student, on_delete=models.CASCADE, blank='false', null='false')
#     subject_id = models.ForeignKey(subject, on_delete=models.CASCADE, blank='false', null='false')
#     remark = models.CharField(max_length=250,blank='true',null='true')

# class Subject(models.Model):
#     subject_id = models.IntegerField(max_length=10)
#     name = models.CharField(max_length=50)
#     subject_type = models.CharField(max_length=10)

# class CoreValues(models.Model):
#     corevalue_id = models.IntegerField(max_length=10)
#     behavior_statement = models.CharField(max_length=300)
#     mark = models.CharField(max_length=2)
