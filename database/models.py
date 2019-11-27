from django.db import models


class Student(models.Model):
	student_id = models.IntegerField(primary_key=True)
	student_first_name = models.CharField(max_length=4)
    student_middle_name = models.CharField(max_length=4)
    student_last_name = models.
	student_birthdate = models.IntegerField()
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

class CoreValues(models.Model):


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
