from django import forms
from django.contrib.auth.forms import UserCreationForm, UserChangeForm
from .models import CustomUser

class CustomUserCreationForm( UserCreationForm ):
	class Meta:
		model = CustomUser
		fields = ('username',)

class CustomUserChangeForm( UserChangeForm ):
	class Meta:
		model = CustomUser
		fields = ('username',)

class TestForm( forms.Form ):
	subjectID = forms.CharField(label='Subject ID')
	yearLevel = forms.CharField(label='Year Level')
	subjectName = forms.CharField(label='Subject Name')