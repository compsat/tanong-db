from django.shortcuts import render, get_object_or_404, redirect
from .forms import RegisterForm, AddStudentForm, AddGrade
from .models import *
from django.http import HttpResponse
from django.contrib.auth.decorators import login_required
from django.forms.models import model_to_dict

def index(request):
	if request.user.is_authenticated:
		return redirect('StudentOutput')
	else:
		return redirect('login')

@login_required
def addGrades(request, student_id):
	message = None
	if 'message' in request.session:
		message = request.session['message']
		del request.session['message']

	student = None

	if Student.objects.filter(pk=student_id).exists():
		student = Student.objects.get(pk=student_id)

		if request.method == 'POST':
			Q1Marks = request.POST.getlist('firstQ_mark')
			Q2Marks = request.POST.getlist('secondQ_mark')
			Q3Marks = request.POST.getlist('thirdQ_mark')
			Q4Marks = request.POST.getlist('fourthQ_mark')
			csrfmiddlewaretoken = request.POST['csrfmiddlewaretoken']
			fil_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[0], 
				'secondQ_mark': Q2Marks[0],
				'thirdQ_mark': Q3Marks[0],
				'fourthQ_mark': Q4Marks[0],
			}
			eng_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[1], 
				'secondQ_mark': Q2Marks[1],
				'thirdQ_mark': Q3Marks[1],
				'fourthQ_mark': Q4Marks[1],
			}
			math_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[2], 
				'secondQ_mark': Q2Marks[2],
				'thirdQ_mark': Q3Marks[2],
				'fourthQ_mark': Q4Marks[2],
			}
			sci_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[3], 
				'secondQ_mark': Q2Marks[3],
				'thirdQ_mark': Q3Marks[3],
				'fourthQ_mark': Q4Marks[3],
			}
			ap_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[4], 
				'secondQ_mark': Q2Marks[4],
				'thirdQ_mark': Q3Marks[4],
				'fourthQ_mark': Q4Marks[4],
			}
			esp_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[5], 
				'secondQ_mark': Q2Marks[5],
				'thirdQ_mark': Q3Marks[5],
				'fourthQ_mark': Q4Marks[5],
			}
			tle_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[6], 
				'secondQ_mark': Q2Marks[6],
				'thirdQ_mark': Q3Marks[6],
				'fourthQ_mark': Q4Marks[6],
			}
			music_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[7], 
				'secondQ_mark': Q2Marks[7],
				'thirdQ_mark': Q3Marks[7],
				'fourthQ_mark': Q4Marks[7],
			}
			arts_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[8], 
				'secondQ_mark': Q2Marks[8],
				'thirdQ_mark': Q3Marks[8],
				'fourthQ_mark': Q4Marks[8],
			}
			pe_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[9], 
				'secondQ_mark': Q2Marks[9],
				'thirdQ_mark': Q3Marks[9],
				'fourthQ_mark': Q4Marks[9],
			}
			health_data = {
				csrfmiddlewaretoken: csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[10], 
				'secondQ_mark': Q2Marks[10],
				'thirdQ_mark': Q3Marks[10],
				'fourthQ_mark': Q4Marks[10],
			}
			fil_form = AddGrade(fil_data)
			eng_form = AddGrade(eng_data)
			math_form = AddGrade(math_data)
			sci_form = AddGrade(sci_data)
			ap_form = AddGrade(ap_data)
			esp_form = AddGrade(esp_data)
			tle_form = AddGrade(tle_data)
			music_form = AddGrade(music_data)
			arts_form = AddGrade(arts_data)
			pe_form = AddGrade(pe_data)
			health_form = AddGrade(health_data)

			passed_forms = False

			if fil_form.is_valid():
				fil_grade = fil_form.save(commit=False)
				fil_grade.subject = Subject.objects.get(pk=11)
				fil_grade.student = student
				fil_grade.save()
				passed_forms = True

			if eng_form.is_valid():
				eng_grade = eng_form.save(commit=False)
				eng_grade.subject = Subject.objects.get(pk=2)
				eng_grade.student = student
				eng_grade.save()
				passed_forms = True

			if math_form.is_valid():
				math_grade = math_form.save(commit=False)
				math_grade.subject = Subject.objects.get(pk=1)
				math_grade.student = student
				math_grade.save()
				passed_forms = True

			if sci_form.is_valid():
				sci_grade = sci_form.save(commit=False)
				sci_grade.subject = Subject.objects.get(pk=3)
				sci_grade.student = student
				sci_grade.save()
				passed_forms = True

			if ap_form.is_valid():
				ap_grade = ap_form.save(commit=False)
				ap_grade.subject = Subject.objects.get(pk=4)
				ap_grade.student = student
				ap_grade.save()
				passed_forms = True

			if esp_form.is_valid():
				esp_grade = esp_form.save(commit=False)
				esp_grade.subject = Subject.objects.get(pk=5)
				esp_grade.student = student
				esp_grade.save()
				passed_forms = True

			if tle_form.is_valid():
				tle_grade = tle_form.save(commit=False)
				tle_grade.subject = Subject.objects.get(pk=6)
				tle_grade.student = student
				tle_grade.save()
				passed_forms = True

			if music_form.is_valid():
				music_grade = music_form.save(commit=False)
				music_grade.subject = Subject.objects.get(pk=7)
				music_grade.student = student
				music_grade.save()
				passed_forms = True

			if arts_form.is_valid():
				arts_grade = arts_form.save(commit=False)
				arts_grade.subject = Subject.objects.get(pk=8)
				arts_grade.student = student
				arts_grade.save()
				passed_forms = True

			if pe_form.is_valid():
				pe_grade = pe_form.save(commit=False)
				pe_grade.subject = Subject.objects.get(pk=9)
				pe_grade.student = student
				pe_grade.save()
				passed_forms = True

			if health_form.is_valid():
				health_grade = health_form.save(commit=False)
				health_grade.subject = Subject.objects.get(pk=10)
				health_grade.student = student
				health_grade.save()
				passed_forms = True

			if passed_forms:
				request.session['message'] = 'Grades successfully added.'
				return redirect('StudentOutput')
			else:
				request.session['message'] = 'There was an error in the grades.'
				return redirect('addGrades', student_id=student_id)
		else:
			fil_form = AddGrade()
			eng_form = AddGrade()
			math_form = AddGrade()
			sci_form = AddGrade()
			ap_form = AddGrade()
			esp_form = AddGrade()
			tle_form = AddGrade()
			music_form = AddGrade()
			arts_form = AddGrade()
			pe_form = AddGrade()
			health_form = AddGrade()

	else:
		request.session['message'] = 'Student does not exist.'
		request.session['message_type'] = 'danger'
		return HttpResponse("Student does not exist")

	context = {
		'fil_form' : fil_form,
		'eng_form' : eng_form,
		'math_form' : math_form,
		'sci_form' : sci_form,
		'ap_form' : ap_form,
		'esp_form' : esp_form,
		'tle_form' : tle_form,
		'music_form' : music_form,
		'arts_form' : arts_form,
		'pe_form' : pe_form,
		'health_form' : health_form,
		'message' : message,
		'student' : student
	}
	return render(request, 'database/add_grades.html', context)

@login_required
def editGrades(request, student_id):
	message = None
	if 'message' in request.session:
		message = request.session['message']
		del request.session['message']

	student = None

	if Student.objects.filter(pk=student_id).exists() and Grade.objects.filter(student__pk=student_id, subject__name="Filipino").exists():
		student = Student.objects.get(pk=student_id)

		fil_grades = Grade.objects.get(student=student, subject__name="Filipino")
		eng_grades = Grade.objects.get(student=student, subject__name="English")
		math_grades = Grade.objects.get(student=student, subject__name="Mathematics")
		sci_grades = Grade.objects.get(student=student, subject__name="Science")
		ap_grades = Grade.objects.get(student=student, subject__name="Araling Panlipunan")
		esp_grades = Grade.objects.get(student=student, subject__name="Edukasyon sa Pagpapakatao")
		tle_grades = Grade.objects.get(student=student, subject__name="Technology and Livelihood Education")
		music_grades = Grade.objects.get(student=student, subject__name="Music")
		arts_grades = Grade.objects.get(student=student, subject__name="Arts")
		pe_grades = Grade.objects.get(student=student, subject__name="Physical Education")
		health_grades = Grade.objects.get(student=student, subject__name="Health")

		if request.method == 'POST':
			Q1Marks = request.POST.getlist('firstQ_mark')
			Q2Marks = request.POST.getlist('secondQ_mark')
			Q3Marks = request.POST.getlist('thirdQ_mark')
			Q4Marks = request.POST.getlist('fourthQ_mark')
			csrfmiddlewaretoken = request.POST['csrfmiddlewaretoken']
			fil_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[0], 
				'secondQ_mark': Q2Marks[0],
				'thirdQ_mark': Q3Marks[0],
				'fourthQ_mark': Q4Marks[0],
			}
			eng_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[1], 
				'secondQ_mark': Q2Marks[1],
				'thirdQ_mark': Q3Marks[1],
				'fourthQ_mark': Q4Marks[1],
			}
			math_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[2], 
				'secondQ_mark': Q2Marks[2],
				'thirdQ_mark': Q3Marks[2],
				'fourthQ_mark': Q4Marks[2],
			}
			sci_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[3], 
				'secondQ_mark': Q2Marks[3],
				'thirdQ_mark': Q3Marks[3],
				'fourthQ_mark': Q4Marks[3],
			}
			ap_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[4], 
				'secondQ_mark': Q2Marks[4],
				'thirdQ_mark': Q3Marks[4],
				'fourthQ_mark': Q4Marks[4],
			}
			esp_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[5], 
				'secondQ_mark': Q2Marks[5],
				'thirdQ_mark': Q3Marks[5],
				'fourthQ_mark': Q4Marks[5],
			}
			tle_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[6], 
				'secondQ_mark': Q2Marks[6],
				'thirdQ_mark': Q3Marks[6],
				'fourthQ_mark': Q4Marks[6],
			}
			music_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[7], 
				'secondQ_mark': Q2Marks[7],
				'thirdQ_mark': Q3Marks[7],
				'fourthQ_mark': Q4Marks[7],
			}
			arts_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[8], 
				'secondQ_mark': Q2Marks[8],
				'thirdQ_mark': Q3Marks[8],
				'fourthQ_mark': Q4Marks[8],
			}
			pe_data = {
				'csrfmiddlewaretoken': csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[9], 
				'secondQ_mark': Q2Marks[9],
				'thirdQ_mark': Q3Marks[9],
				'fourthQ_mark': Q4Marks[9],
			}
			health_data = {
				csrfmiddlewaretoken: csrfmiddlewaretoken,
				'firstQ_mark': Q1Marks[10], 
				'secondQ_mark': Q2Marks[10],
				'thirdQ_mark': Q3Marks[10],
				'fourthQ_mark': Q4Marks[10],
			}
			fil_form = AddGrade(fil_data)
			eng_form = AddGrade(eng_data)
			math_form = AddGrade(math_data)
			sci_form = AddGrade(sci_data)
			ap_form = AddGrade(ap_data)
			esp_form = AddGrade(esp_data)
			tle_form = AddGrade(tle_data)
			music_form = AddGrade(music_data)
			arts_form = AddGrade(arts_data)
			pe_form = AddGrade(pe_data)
			health_form = AddGrade(health_data)

			passed_forms = False

			if fil_form.is_valid():
				fil_grade = fil_form.save(commit=False)
				fil_grades.firstQ_mark = fil_grade.firstQ_mark
				fil_grades.secondQ_mark = fil_grade.secondQ_mark
				fil_grades.thirdQ_mark = fil_grade.thirdQ_mark
				fil_grades.fourthQ_mark = fil_grade.fourthQ_mark
				fil_grades.save()
				passed_forms = True

			if eng_form.is_valid():
				eng_grade = eng_form.save(commit=False)
				eng_grades.firstQ_mark = eng_grade.firstQ_mark
				eng_grades.secondQ_mark = eng_grade.secondQ_mark
				eng_grades.thirdQ_mark = eng_grade.thirdQ_mark
				eng_grades.fourthQ_mark = eng_grade.fourthQ_mark
				eng_grades.save()
				passed_forms = True

			if math_form.is_valid():
				math_grade = math_form.save(commit=False)
				math_grades.firstQ_mark = math_grade.firstQ_mark
				math_grades.secondQ_mark = math_grade.secondQ_mark
				math_grades.thirdQ_mark = math_grade.thirdQ_mark
				math_grades.fourthQ_mark = math_grade.fourthQ_mark
				math_grades.save()
				passed_forms = True

			if sci_form.is_valid():
				sci_grade = sci_form.save(commit=False)
				sci_grades.firstQ_mark = sci_grade.firstQ_mark
				sci_grades.secondQ_mark = sci_grade.secondQ_mark
				sci_grades.thirdQ_mark = sci_grade.thirdQ_mark
				sci_grades.fourthQ_mark = sci_grade.fourthQ_mark
				sci_grades.save()
				passed_forms = True

			if ap_form.is_valid():
				ap_grade = ap_form.save(commit=False)
				ap_grades.firstQ_mark = ap_grade.firstQ_mark
				ap_grades.secondQ_mark = ap_grade.secondQ_mark
				ap_grades.thirdQ_mark = ap_grade.thirdQ_mark
				ap_grades.fourthQ_mark = ap_grade.fourthQ_mark
				ap_grades.save()
				passed_forms = True

			if esp_form.is_valid():
				esp_grade = esp_form.save(commit=False)
				esp_grades.firstQ_mark = esp_grade.firstQ_mark
				esp_grades.secondQ_mark = esp_grade.secondQ_mark
				esp_grades.thirdQ_mark = esp_grade.thirdQ_mark
				esp_grades.fourthQ_mark = esp_grade.fourthQ_mark
				esp_grades.save()
				passed_forms = True

			if tle_form.is_valid():
				tle_grade = tle_form.save(commit=False)
				tle_grades.firstQ_mark = tle_grade.firstQ_mark
				tle_grades.secondQ_mark = tle_grade.secondQ_mark
				tle_grades.thirdQ_mark = tle_grade.thirdQ_mark
				tle_grades.fourthQ_mark = tle_grade.fourthQ_mark
				tle_grades.save()
				passed_forms = True

			if music_form.is_valid():
				music_grade = music_form.save(commit=False)
				music_grades.firstQ_mark = music_grade.firstQ_mark
				music_grades.secondQ_mark = music_grade.secondQ_mark
				music_grades.thirdQ_mark = music_grade.thirdQ_mark
				music_grades.fourthQ_mark = music_grade.fourthQ_mark
				music_grades.save()
				passed_forms = True

			if arts_form.is_valid():
				arts_grade = arts_form.save(commit=False)
				arts_grades.firstQ_mark = arts_grade.firstQ_mark
				arts_grades.secondQ_mark = arts_grade.secondQ_mark
				arts_grades.thirdQ_mark = arts_grade.thirdQ_mark
				arts_grades.fourthQ_mark = arts_grade.fourthQ_mark
				arts_grades.save()
				passed_forms = True

			if pe_form.is_valid():
				pe_grade = pe_form.save(commit=False)
				pe_grades.firstQ_mark = pe_grade.firstQ_mark
				pe_grades.secondQ_mark = pe_grade.secondQ_mark
				pe_grades.thirdQ_mark = pe_grade.thirdQ_mark
				pe_grades.fourthQ_mark = pe_grade.fourthQ_mark
				pe_grades.save()
				passed_forms = True

			if health_form.is_valid():
				health_grade = health_form.save(commit=False)
				health_grades.firstQ_mark = health_grade.firstQ_mark
				health_grades.secondQ_mark = health_grade.secondQ_mark
				health_grades.thirdQ_mark = health_grade.thirdQ_mark
				health_grades.fourthQ_mark = health_grade.fourthQ_mark
				health_grades.save()
				passed_forms = True

			if passed_forms:
				request.session['message'] = 'Grades successfully added.'
				request.session['message_type'] = 'success'
				return redirect('StudentOutput')
			else:
				request.session['message'] = 'There was an error in the grades.'
				return redirect('addGrades', student_id=student_id)
		else:
			fil_form = AddGrade(model_to_dict(fil_grades))
			eng_form = AddGrade(model_to_dict(eng_grades))
			math_form = AddGrade(model_to_dict(math_grades))
			sci_form = AddGrade(model_to_dict(sci_grades))
			ap_form = AddGrade(model_to_dict(ap_grades))
			esp_form = AddGrade(model_to_dict(esp_grades))
			tle_form = AddGrade(model_to_dict(tle_grades))
			music_form = AddGrade(model_to_dict(music_grades))
			arts_form = AddGrade(model_to_dict(arts_grades))
			pe_form = AddGrade(model_to_dict(pe_grades))
			health_form = AddGrade(model_to_dict(health_grades))

	else:
		request.session['message'] = 'Student does not exist.'
		request.session['message_type'] = 'danger'
		return HttpResponse("Student does not exist")

	grades_list = Grade.objects.filter(student=student)

	context = {
		'fil_form' : fil_form,
		'eng_form' : eng_form,
		'math_form' : math_form,
		'sci_form' : sci_form,
		'ap_form' : ap_form,
		'esp_form' : esp_form,
		'tle_form' : tle_form,
		'music_form' : music_form,
		'arts_form' : arts_form,
		'pe_form' : pe_form,
		'health_form' : health_form,
		'grades_list' : grades_list,
		'message' : message,
		'student' : student
	}
	return render(request, 'database/add_grades.html', context)

def register(request):
	"""
	To know what POST is and how it's different from GET, read this: https://www.w3schools.com/tags/ref_httpmethods.asp
	For now, all you need to know is if you're submitting data to the server, you usually do a POST request.
	"""

	# If it's a POST request, then get the data filled out in the form (check out forms.py), and save it to the model.
	if request.method == 'POST':
		form = RegisterForm(request.POST)
		if form.is_valid():
			request.session['email'] = request.POST['email']
			request.session['first_name'] = request.POST['first_name']
			request.session['last_name'] = request.POST['last_name']
			request.session['password1'] = request.POST['password1']
			request.session['access_field'] = request.POST['access_field']
			request.session['year_level'] = request.POST['year_level']
			request.session['section_name'] = request.POST['section_name']
			return redirect('conf_reg')
	else:
		form = RegisterForm()

		if 'initial_data' in request.session:
			form = RegisterForm(initial=request.session['initial_data'])
			del request.session['initial_data']

	# "Load" this view in the register.html template, with the "form" variable passed as a variable to the html template.
	return render(request, 'database/register.html', {'form' : form})

def confirm(request):
	if 'email' in request.session:
		email = request.session['email']
		first_name = request.session['first_name']
		last_name = request.session['last_name']
		password1 = request.session['password1']
		access_field = request.session['access_field']
		year_level = request.session['year_level']
		section_name = request.session['section_name']
		access_object = AccessCode.objects.get(code=access_field)

		if request.method == 'POST':
			if 'confirm_reg' in request.POST:
				user = User.objects.create(email=email, first_name=first_name, last_name=last_name, access_object=access_object)
				section = Section.objects.create(year_level=year_level, name=section_name, adviser=user)
				user.set_password(password1)
				user.save()
				del request.session['email']
				del request.session['first_name']
				del request.session['last_name']
				del request.session['password1']
				del request.session['access_field']
				del request.session['year_level']
				del request.session['section_name']
				request.session['message'] = 'Account successfully created. Please log in.'
				request.session['message_type'] = 'primary'
				return redirect('index')
			elif 'go_back' in request.POST:
				request.session['initial_data'] = {
					'email' : email,
					'first_name' : first_name,
					'last_name' : last_name,
					'access_field' : access_field,
					'year_level' : year_level,
					'section_name' : section_name,
				}

				del request.session['email']
				del request.session['first_name']
				del request.session['last_name']
				del request.session['password1']
				del request.session['access_field']
				del request.session['year_level']
				del request.session['section_name']
				return redirect('register')

		context = {'first_name' : first_name, 'last_name':last_name, 'email': email, 'section' : '{}-{}'.format(year_level, section_name)}
		return render(request, 'database/confirmation.html', context)

	else:
		return redirect('register')

'''def login(request):
	if request.method == 'POST':
		form = RegisterForm(request.POST)
	else:
		form = RegisterForm()
	
	return render(request, 'database/login.html', {'form' : form}) '''

@login_required
def AddStudent(request):
	if request.method == 'POST':
		form = AddStudentForm(request.POST)
		if form.is_valid():
			student = form.save(commit=False)
			student.section = request.user.section
			student.save()
			if 'proceed' in request.POST:
				return redirect('addGrades', student_id=student.pk)
			elif 'skip' in request.POST:
				request.session['message'] = 'Successfully added a student record'
				return redirect('index')
	else:
		form = AddStudentForm()

	return render(request, 'database/AddStudent.html', {'form' : form})

@login_required
def EditStudent(request, pk):
	if Student.objects.filter(pk=pk).exists():
		orig_student = Student.objects.get(pk=pk)
		name = orig_student.full_name
		if request.method == 'POST':
			form = AddStudentForm(request.POST)
			if form.is_valid():
				student = form.save(commit=False)
				orig_student.last_name = student.last_name
				orig_student.first_name = student.first_name
				orig_student.middle_name = student.middle_name
				orig_student.birth_date = student.birth_date
				orig_student.LRN = student.LRN
				orig_student.sex = student.sex
				orig_student.save()
				request.session['message'] = 'Successfully edited the student record'
				return redirect('StudentOutput')
		else:
			form = AddStudentForm(model_to_dict(orig_student))

		return render(request, 'database/AddStudent.html', {'form' : form, 'name' : name, 'is_editing' : True})

	request.session['message'] = 'Student does not exist'
	return redirect('index')

@login_required
def StudentOutput(request):
	message = None
	if 'message' in request.session:
		message = request.session['message']
		del request.session['message']

	section = None
	if hasattr(request.user, 'section'):
		section = request.user.section
	latest_student_list = Student.objects.filter(section=section).order_by('last_name')

	return render(request, 'database/StudentOutput.html', {'latest_student_list' : latest_student_list, 'section' : section, 'message' : message})

@login_required
def StudentInfo(request, pk):

	if Student.objects.filter(pk=pk).exists():
		student = Student.objects.get(pk=pk)

		if request.method == 'POST':
			if 'edit_student' in request.POST:
				return redirect('EditStudent', pk=pk)
			elif 'view_grades' in request.POST:
				return redirect('GradesOutput', student_id=pk)
			elif 'add_grades' in request.POST:
				return redirect('addGrades', student_id=pk)

		return render(request, 'database/StudentInfo.html', {'student' : student, 'has_grades' : len(student.grades.all()) > 0})

	return redirect('index')

@login_required
def GradesOutput(request, student_id):
	student = Student.objects.get(pk=student_id)
	grades_list = Grade.objects.filter(student=student)

	return render(request, 'database/gradesOutput.html', {'grades_list': grades_list, 'student' : student})
