from django.db import models

class SchoolYear(models.Model):
	year_id = models.IntegerField(primary_key=True)
	year_start = models.CharField(max_length=4)
	year_end = models.CharField(max_length=4) #derived?
	year_level = models.IntegerField()
	def __str__(self):
		return self.year_start+' - '+self.year_end+' | '+self.year_level

class Adviser(models.Model):
	adviser_id = models.AutoField(primary_key=True)
	first_name = models.CharField(max_length=70)
	last_name = models.CharField(max_length=50)
	name_extension = models.CharField(max_length=3,null=True)
	middle_name = models.CharField(max_length=50,null=True)
	def __str__(self):
		return self.first_name+' '+self.last_name

class Section(models.Model):
	section_id = models.AutoField(primary_key=True)
	section_name = models.CharField(max_length=50)
	year_id = models.ForeignKey(SchoolYear,on_delete=models.CASCADE)
	adviser_id = models.ForeignKey(Adviser,on_delete=models.DO_NOTHING)
	def __str__(self):
		return self.section_name

class LearnerCitations(models.Model):
	citation_id = models.AutoField(primary_key=True)
	citation = models.CharField(max_length=255) # not sure
	class Meta:
		unique_together = (('citation_id','citation'),)

class Learner(models.Model):
	BIOLOGICAL_SEX = (('M','Male'),('F','Female'),)
	STATUS_CHOICES = (('E','Currently Enrolled'),('NE','Not Currently Enrolled'),('ETR','Currently Enrolled Transferee'),('NETR','Not Currently Enrolled Transferee'),('T','Transferred'),)	
	learner_id = models.AutoField(primary_key=True)
	lrn = models.CharField(max_length=12,null=True,unique=True)
	first_name = models.CharField(max_length=70)
	middle_name = models.CharField(max_length=50,null=True)
	last_name = models.CharField(max_length=50)
	name_extension = models.CharField(max_length=3,null=True)
	date_of_birth = models.DateField()
	sex = models.CharField(max_length=1,choices=BIOLOGICAL_SEX,null=True)
	status = models.CharField(max_length=4,choices=STATUS_CHOICES,null=True,default='E')
	citation_id = models.ForeignKey(LearnerCitations,on_delete=models.DO_NOTHING,null=True)
	def __str__(self):
		return self.first_name + ' ' + self.last_name

class Credential(models.Model):
	credential_id = models.AutoField(primary_key=True)
	learner_id = models.ForeignKey(Learner,on_delete=models.CASCADE)
	credential = models.CharField(max_length=255)
	
# associative entity
class LearnerSection(models.Model):
	learner_id = models.ForeignKey(Learner,on_delete=models.DO_NOTHING)
	section_id = models.ForeignKey(Section,on_delete=models.DO_NOTHING)
	class_number = models.IntegerField()
	class Meta:
		unique_together = (('learner_id','section_id'),)

class LearnerFiles(models.Model):
	file_id = models.AutoField(primary_key=True)
	file_name = models.CharField(max_length=255)
	file_path = models.CharField(max_length=255)
	learner_id = models.ForeignKey(Learner,on_delete=models.CASCADE)

class Assessment(models.Model):
	TYPE = (('A','ALS A&E'),('P','PEPT'),('O','Other'))
	assessment_id = models.AutoField(primary_key=True)
	assessment_type = models.CharField(max_length=1,choices=TYPE) 
	assessment_name = models.CharField(max_length=255,null=True)

class TestingCenter(models.Model):
	testing_center_id = models.AutoField(primary_key=True)
	testing_center_name = models.CharField(max_length=255)
	testing_center_address = models.CharField(max_length=255)
		
class ElementarySchool(models.Model):
	school_id = models.AutoField(primary_key=True)
	school_name = models.CharField(max_length=255)
	school_address = models.CharField(max_length=255)

class Qualification(models.Model):
	TYPE = (('A','Assessment'),('E','Elementary Diploma'),)
	qualification_id = models.AutoField(primary_key=True)
	qualification_type = models.CharField(max_length=1,choices=TYPE) 
	learner_id = models.ForeignKey(Learner,on_delete=models.CASCADE)
	
class LearnerAssessment(Qualification):
	date = models.DateField()
	rating = models.IntegerField()
	testing_center_id = models.ForeignKey(TestingCenter,on_delete=models.DO_NOTHING) 
	assessment_id = models.ForeignKey(Assessment,on_delete=models.DO_NOTHING)
	# has qualification_id
	# has qualification_type
	# has learner_id
	
class ElementaryDiploma(Qualification):
	general_average = models.DecimalField(max_digits=5,decimal_places=2)
	school_id = models.ForeignKey(ElementarySchool,on_delete=models.DO_NOTHING)
	# has qualification_id
	# has qualification_type
	# has learner_id

class User(models.Model):
	ACCOUNT_TYPE = (('A','Administrator'),('T','Teacher'),)
	account_id = models.AutoField(primary_key=True)
	first_name = models.CharField(max_length=70)
	last_name = models.CharField(max_length=50)
	name_extension = models.CharField(max_length=3,null=True)
	middle_name = models.CharField(max_length=50,null=True)
	username = models.CharField(max_length=255)
	password = models.CharField(max_length=255) # not sure, we will have to do hashing
	account_type = models.CharField(max_length=1,choices=ACCOUNT_TYPE)

