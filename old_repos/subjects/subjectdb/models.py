from django.db import models
from django.core.validators import MinValueValidator 
from django.contrib.auth.models import AbstractUser

# Create your models here.

# class User_t( models.Model ):
#	class Meta:
#		verbose_name_plural = "Users"
#		
#	username = models.CharField(max_length=40, primary_key=True)
#	password = models.CharField(max_length=10)
#	teacherSurname = models.CharField(max_length=30, blank=True)
#	teacherFirstName = models.CharField(max_length=50, blank=True)
#	teacherMI = models.CharField(max_length=3, blank=True)
#	def __str__(self):
#		return self.username

# CustomUser model
class CustomUser( AbstractUser ):
	teacherSurname = models.CharField(max_length=30, blank=True)
	teacherFirstName = models.CharField(max_length=50, blank=True)
	teacherMI = models.CharField(max_length=3, blank=True)

# Subject model
class Subject_t( models.Model ):
	class Meta:
		verbose_name = "Subject"
		verbose_name_plural = "Subjects"

	subjectID = models.CharField(max_length=15, primary_key=True)
	yearLevel = models.IntegerField(validators=[MinValueValidator(1)])
	subjectName = models.CharField(max_length=80)

	def __str__(self):
		return self.subjectID

# Class model
class Class_t( models.Model ):
	class Meta:
		verbose_name_plural = "Classes"

	classID = models.PositiveIntegerField(primary_key = True)
	subjectID = models.ForeignKey(Subject_t, on_delete=models.CASCADE)
	username = models.ForeignKey(CustomUser, on_delete=models.CASCADE)
	section = models.CharField(max_length=20)
	schoolYear = models.CharField(max_length=15)

	def __str__(self):
		details = "Class ID " + str(self.classID) + " of " + str(self.subjectID)
		return details

# Student model
class Student_t( models.Model ):
	class Meta:
		verbose_name_plural = "Students"

	studentSurname = models.CharField(max_length=30)
	studentFirstName = models.CharField(max_length=50)
	studentMI = models.CharField(max_length=3)

	def __str__(self):
		details = self.studentSurname + " with Student ID " + str(self.id)
		return details

# Grade model
class Grade_t( models.Model ):
	class Meta:
		unique_together = (('classID', 'studentID'))
		verbose_name_plural = "Grades"

	classID = models.ForeignKey(Class_t, on_delete=models.CASCADE)
	studentID = models.ForeignKey(Student_t, on_delete=models.CASCADE)
	Q1grade = models.PositiveIntegerField()
	Q2grade = models.PositiveIntegerField()
	Q3grade = models.PositiveIntegerField()
	Q4grade = models.PositiveIntegerField()
	finalGrade = models.PositiveIntegerField()
	remark = models.CharField(max_length=20)

# Subject Teacher Assignment model
class SubjTeachA_t( models.Model ):
	class Meta:
		unique_together = (('subjectID', 'username'))
		verbose_name_plural = "Subject Teacher Assignments"

	username = models.ForeignKey(CustomUser, on_delete=models.CASCADE)
	subjectID = models.ForeignKey(Subject_t, on_delete=models.CASCADE)
	yearLevel = models.IntegerField(validators=[MinValueValidator(1)])
	teacherAssigned = models.CharField(max_length=60)