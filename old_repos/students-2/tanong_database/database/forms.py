from django import forms
from .models import User, AccessCode, Student, Grade, Section
from django.contrib.auth import authenticate
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm

class LoginForm(AuthenticationForm):
	def __init__(self, *args, **kwargs):
		super(LoginForm, self).__init__(*args, **kwargs)
		self.fields['username'].widget.attrs={
			'id' : 'signInEmail',
			'class' : 'form-control',
		}
		self.fields['password'].widget.attrs={
			'id' : 'signinPassword',
			'class' : 'form-control',
		}

"""
Form for the registration view, extended from the Django built-in UserCreationForm
"""
class RegisterForm(UserCreationForm):
	access_field = forms.CharField(max_length=20)
	year_level = forms.IntegerField()
	section_name = forms.CharField(max_length=50)

	class Meta:
		"""
		Form uses the User model made by me, and uses these fields along with an extra field I made called "access_field"
		"""
		model = User
		fields = ['email', 'first_name', 'last_name', 'access_field', 'year_level', 'section_name']

	def __init__(self, *args, **kwargs):
		super(RegisterForm, self).__init__(*args, **kwargs)
		self.fields['email'].widget.attrs={
			'id' : 'exampleInputEmail1',
			'class' : 'form-control',
			'aria-describedby' : 'emailHelp'
		}
		self.fields['first_name'].widget.attrs={
			'id' : 'exampleInputName',
			'class' : 'form-control',
			'aria-describedby' : 'emailHelp'
		}
		self.fields['last_name'].widget.attrs={
			'id' : 'exampleInputName',
			'class' : 'form-control',
			'aria-describedby' : 'emailHelp'
		}
		self.fields['password1'].widget.attrs={
			'id' : 'exampleInputPassword1',
			'class' : 'form-control',
		}
		self.fields['password2'].widget.attrs={
			'id' : 'exampleInputPassword2',
			'class' : 'form-control',
		}
		self.fields['access_field'].widget.attrs={
			'id' : 'exampleInputAccess',
			'class' : 'form-control',
		}
		self.fields['year_level'].widget.attrs={
			'id' : 'exampleInputYear',
			'class' : 'form-control',
		}
		self.fields['section_name'].widget.attrs={
			'id' : 'exampleInputSection',
			'class' : 'form-control',
		}

	def is_valid(self):
		"""
		Don't mind this for now, but this method basically checks if the access code the user put in the field is valid
		or has not been used by another user, along with checking if the fields are valid (such as checking correct email, etc).

		You don't need this method usually. I implemented this because of the access code, but otherwise on a normal occasion,
		you won't need to write this method.
		"""
 
        # run the parent validation first
		valid = super(RegisterForm, self).is_valid()
 
        # we're done now if not valid
		if not valid:
			return valid

		access_code = self.cleaned_data['access_field']
		year = self.cleaned_data['year_level']
		section_name = self.cleaned_data['section_name']
 
		try:
			access_object = AccessCode.objects.get(code=access_code)
 
		except AccessCode.DoesNotExist:
			self.add_error('access_field', "Invalid access code")
			return False

		if hasattr(AccessCode.objects.get(code=access_code), 'user'):
			self.add_error('access_field', "Access code has been used")
			return False

		if year < 7 or year >= 11:
			self.add_error('year_level', "Please input a year level in JHS only.")
			return False

		try:
			section = Section.objects.get(name=section_name)
			self.add_error('section_name', "This section already has an adviser.")
			return False
		
		except Section.DoesNotExist:
			pass

		return True

class AddStudentForm(forms.ModelForm):
	
	class Meta:
		model = Student
		fields = ['last_name', 'first_name', 'middle_name', 'birth_date', 'LRN', 'sex']	

	def __init__(self, *args, **kwargs):
		super(AddStudentForm, self).__init__(*args, **kwargs)
		self.fields['last_name'].widget.attrs={
			'id' : 'inputLastName',
			'class' : 'form-control',
		}
		self.fields['first_name'].widget.attrs={
			'id' : 'inputFirstName',
			'class' : 'form-control',
		}
		self.fields['middle_name'].widget.attrs={
			'id' : 'inputMiddleName',
			'class' : 'form-control',
		}
		self.fields['birth_date'].widget.attrs={
			'id' : 'inputBirthDate',
			'class' : 'form-control',
		}
		self.fields['LRN'].widget.attrs={
			'id' : 'inputLRN',
			'class' : 'form-control',
		}
		self.fields['sex'].widget.attrs={
			'id' : 'inputSex',
			'class' : 'form-control',
		}

class AddGrade(forms.ModelForm):

	class Meta:
		model = Grade
		fields = ['firstQ_mark', 'secondQ_mark', 'thirdQ_mark', 'fourthQ_mark']

	def __init__(self, *args, **kwargs):
		super(AddGrade, self).__init__(*args, **kwargs)
		self.fields['firstQ_mark'].widget.attrs={
			'class' : 'form-control',
			'style' : 'width: 70%'
		}
		self.fields['secondQ_mark'].widget.attrs={
			'class' : 'form-control',
			'style' : 'width: 70%'
		}
		self.fields['thirdQ_mark'].widget.attrs={
			'class' : 'form-control',
			'style' : 'width: 70%'
		}
		self.fields['fourthQ_mark'].widget.attrs={
			'class' : 'form-control',
			'style' : 'width: 70%'
		}

class AdminAccessCodeAddForm(forms.ModelForm):
	quantity = forms.IntegerField()

	class Meta:
		model = AccessCode
		fields = ['quantity']

class AdminAccessCodeChangeForm(forms.ModelForm):
	class Meta:
		model = AccessCode
		fields = ['code']
