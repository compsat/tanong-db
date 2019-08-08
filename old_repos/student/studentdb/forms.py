from django import forms
from studentdb.models import *

# https://colinkingswood.github.io/Model-Form-Customisation/
# https://simpleisbetterthancomplex.com/article/2017/08/19/how-to-render-django-form-manually.html

class CreateStudent(forms.ModelForm):
	class Meta:
		model = Learner
		fields = ('lrn','first_name','middle_name','last_name','name_extension','date_of_birth','sex',)
		widgets = { 'lrn' : forms.NumberInput(), 'date_of_birth' : forms.DateInput() }
		labels = {	"lrn" : "Learner Reference Number (LRN)", "first_name" : "First Name/s", "last_name" : "Last Name", "name_extension" : "Name Extension", "middle_name" : "Middle Name", "date_of_birth" : "Date of Birth (YYYY-MM-DD)" }
	
	def clean_lrn(self):
		lrn = self.cleaned_data['lrn']
		if len(lrn) != 12:
			raise forms.ValidationError("LRN must be 12 digits long.")
		return lrn
	
	def __init__(self, *args, **kwargs):
		super(CreateStudent, self).__init__(*args, **kwargs)
		self.fields['middle_name'].required = False
		self.fields['name_extension'].required = False

class AddQualificationType(forms.ModelForm):
	class Meta:
		model = Qualification
		exclude = ('learner_id',)
		labels = { "qualification_type": "Eligibility Type" }

# rn we are just using autofields for elementary schools
class AddSchool(forms.ModelForm):
	class Meta:
		model = ElementarySchool
		exclude = ( 'school_id', )
		labels = { "school_name" : "School Name", "school_address" : "School Address"}

class AddDiploma(forms.ModelForm):
	class Meta:
		model = ElementaryDiploma
		fields = ( 'general_average', )
		labels = { "general_average": "General Average (up to 2 decimal places)" }
	
	def clean_general_average(self):
		general_average = self.cleaned_data['general_average']
		if general_average > 100.00 or general_average < 0.00:
			raise forms.ValidationError("General Average must be a positive decimal value less than 100.")
		return general_average

class AddAssessmentForm(forms.ModelForm):
	class Meta:
		model = Assessment
		exclude = ('assessment_id',)
	
	def __init__(self, *args, **kwargs):
		super(AddAssessmentForm, self).__init__(*args, **kwargs)
		self.fields['assessment_name'].required = False

class LearnerAssessment(forms.ModelForm):
	class Meta:
		model = LearnerAssessment
		fields = ('date','rating',)
		labels = { "date":"Date (YYYY-MM-DD):" }
		widgets = { "date": forms.DateInput() }
	
	def clean_rating(self):
		rating = self.cleaned_data['rating']
		if rating > 100 or rating < 0:
			raise forms.ValidationError("Rating must be a positive integer less than 100.")
		return rating

class TestingCenterForm(forms.ModelForm):
	class Meta:
		model = TestingCenter
		exclude = ('testing_center_id',)

class AddYear(forms.ModelForm):
	class Meta: #define the metadata that relate to this class
		model = SchoolYear
		exclude = ('year_id',)
	
	def clean_year_start(self):
		start = self.cleaned_data['year_start']
		if len(start) > 4:
			raise forms.ValidationError("Must be a valid year.")
		return start
	
	def clean_year_end(self):
		end = self.cleaned_data['year_end']
		if len(end) > 4:
			raise forms.ValidationError("Must be a valid year.")
		return end
	
	def clean_year_level(self):
		yr = self.cleaned_data['year_level']
		if yr not in [1, 2, 3, 4, 7, 8, 9, 10]:
			raise forms.ValidationError("Year must be a valid year level. (1, 2, 3, 4, 7, 8, 9, or 10)")
		return yr

class AddAdviser(forms.ModelForm):
	class Meta:
		model = Adviser
		exclude = ('adviser_id',)
	
	def __init__(self, *args, **kwargs):
		super(AddAdviser, self).__init__(*args, **kwargs)
		self.fields['middle_name'].required = False
		self.fields['name_extension'].required = False

class AddSection(forms.ModelForm):
	class Meta:
		model = Section
		exclude = ('section_id','year_id',)
		labels = {"section_name":"Section Name","adviser_id":"Adviser Name"}