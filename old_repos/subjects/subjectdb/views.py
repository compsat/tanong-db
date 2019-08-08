from django.shortcuts import render
from django.contrib.auth import authenticate, login
from django.http import HttpResponse
from subjectdb.forms import TestForm
from django.views.generic import TemplateView
from subjectdb.models import Subject_t

# Create your views here.
def index(request):
	return HttpResponse("Hello world. You are in app subjectdb.")

def login(request):
	#return HttpResponse("log in page")
	return render(request,"subjectdb/LogIn.html")

def adminlanding(request):
	return render(request,"subjectdb/AdminLanding.html")

def teacherlanding(request):
	return render(request,"subjectdb/TeacherLanding.html")

def subjects(request):
	return render(request,"subjectdb/Subjects.html")

def yearlevel(request):
	return render(request,"subjectdb/YearLevel.html")

def teachermanagement(request):
	return render(request,"subjectdb/TeacherManagement.html")

class TestView(TemplateView):
	template_name = 'subjectdb/test.html'

	def get(self, request):
		form = TestForm()
		return render(request, self.template_name, {'form' : form})

	def post(self, request):
		form = TestForm(request.POST)

		if form.is_valid():
			subjectID = form.cleaned_data['subjectID']
			yearLevel = form.cleaned_data['yearLevel']
			subjectName = form.cleaned_data['subjectName']

			subj = Subject_t.objects.create(subjectID=subjectID, yearLevel=yearLevel, subjectName=subjectName)

		args = {
		'form' : form, 
		'subjectID' : subjectID,
		'yearLevel' : yearLevel,
		'subjectName' : subjectName
		}

		return render(request, self.template_name, args)