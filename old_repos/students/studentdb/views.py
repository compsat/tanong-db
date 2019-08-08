from django.shortcuts import render,redirect
from django.http import HttpResponse
from django.views.generic.base import TemplateView
# from django.views.generic.base import MultipleModelView
from django.urls import reverse
from django.views.generic.list import ListView

from studentdb.models import *
from studentdb.forms import *
from studentdb.models import LearnerAssessment as LearnerAssessmentModel

# from django.contrib.auth.form import UserCreationForm
# Create your views here.
# Views are the things that connect the html stuff to the database stuff
# https://docs.djangoproject.com/en/2.2/topics/class-based-views/
# https://www.youtube.com/watch?v=qwE9TFNub84&list=PLw02n0FEB3E3VSHjyYMcFadtQORvl1Ssj&index=47 for the credentials and eligibility

class AddCitations(TemplateView):
	template_name = 'studentdb/add_citations.html'

class AddEligibility(TemplateView):
	template_name = 'studentdb/add_eligibility.html'
	
	def get( self, request, learner_id, qual_id ):
		add_school = AddSchool(prefix = "add_school")
		add_diploma = AddDiploma(prefix = "add_diploma")
		return render(request, self.template_name, {'add_school':add_school, 'add_diploma':add_diploma,'learner_id':learner_id})
	
	def post( self, request, learner_id, qual_id ):
		add_school = AddSchool(request.POST, prefix = "add_school")
		add_diploma = AddDiploma(request.POST, prefix = "add_diploma")
		school_name = None
		school_address = None
		general_average = None
		if add_school.is_valid() and add_diploma.is_valid():
			school_name = add_school.cleaned_data['school_name']
			school_address = add_school.cleaned_data['school_address']
			add_school.save()
			s_id = ElementarySchool.objects.last()
			general_average = add_diploma.cleaned_data['general_average']
			temp = add_diploma.save(commit=False)
			temp.qualification_id = qual_id
			temp.school_id = s_id
			temp.learner_id = Learner.objects.get(learner_id=learner_id)
			temp.qualification_type = getattr(Qualification.objects.last(),'qualification_type')
			temp.save()
			add_school = AddSchool(prefix = "add_school")
			add_diploma = AddDiploma(prefix = "add_diploma")
			return redirect('home-view')
		args = {'add_school':add_school,'add_diploma':add_diploma,'school_name':school_name,'school_address':school_address,'general_average':general_average,'learner_id':learner_id}
		return render(request,self.template_name,args)

class AddFiles(TemplateView):
	template_name = 'studentdb/add_files.html'
	
class AddSchoolYear(TemplateView):
	template_name = 'studentdb/add_school_year.html'

	def get(self, request):
		add_school_year = AddYear(prefix="add_school_year")
		return render(request, self.template_name, {'add_school_year': add_school_year})
	
	def post(self, request):
		add_school_year = AddYear(request.POST, prefix="add_school_year")
		year_start = None;
		year_end = None;
		year_level = None;
		if add_school_year.is_valid():
			year_start = add_school_year.cleaned_data['year_start']
			year_end = add_school_year.cleaned_data['year_end']
			year_level = add_school_year.cleaned_data['year_level']
			temp = add_school_year.save(commit=False)
			temp.year_id = int(str(year_level)+year_start)
			temp.save()
			return redirect('view-school-years')

		args = {'add_school_year': add_school_year, 'year_start': year_start, 'year_end': year_end, 'year_level': year_level}
		return render(request,self.template_name,args)
	
class AddStudentToSection(TemplateView):
	template_name = 'studentdb/add_student_to_section.html'

class CreateStudentView(TemplateView):
	template_name = 'studentdb/add_students.html'
	
	def get(self, request):
		create_student = CreateStudent(prefix="create_student")
		qualification = AddQualificationType(prefix="qualification")
		return render(request, self.template_name, {'create_student':create_student, 'qualification':qualification } )
		
	def post(self, request):
		create_student = CreateStudent(request.POST,prefix="create_student")
		qualification = AddQualificationType(request.POST,prefix="qualification")
		lrn = None
		first_name = None
		last_name = None
		name_extension = None
		middle_name = None
		qualification_type = None
		if create_student.is_valid() and qualification.is_valid():
			# saving form data to Learner model
			lrn = create_student.cleaned_data['lrn']
			first_name = create_student.cleaned_data['first_name']
			last_name = create_student.cleaned_data['last_name']
			name_extension = create_student.cleaned_data['name_extension']
			middle_name = create_student.cleaned_data['middle_name']
			create_student.save()
			l_id = Learner.objects.last()
			qualification_type = qualification.cleaned_data['qualification_type']
			# adding learner_id to Qualification model
			temp = qualification.save(commit=False)
			temp.learner_id = l_id
			temp.save()
			create_student = CreateStudent(prefix="create_student")
			qualification = AddQualificationType(prefix="qualification")
			if( qualification_type == 'E' ): # Elem school
				return redirect(reverse('add-eligibility', kwargs={"learner_id":getattr(l_id,'learner_id'), "qual_id"
				:getattr(Qualification.objects.last(),'qualification_id')}))
			else: # Assessment
				return redirect(reverse('add-assessment', kwargs={"learner_id":getattr(l_id,'learner_id'), "qual_id"
				:getattr(Qualification.objects.last(),'qualification_id')}))
		print(first_name)
		args = {'create_student':create_student, 'qualification':qualification, 'lrn':lrn, 'first_name':first_name, 'last_name':last_name, 'name_extension':name_extension, 'middle_name':middle_name}
		return render(request,self.template_name,args)

class AddAssessment(TemplateView):
	template_name = 'studentdb/assessment.html'
	
	def get( self, request, learner_id, qual_id ):
		assessment = AddAssessmentForm(prefix="assessment")
		learner_assessment = LearnerAssessment(prefix="learner_assessment")
		testing_center = TestingCenterForm(prefix="testing_center")
		return render(request, self.template_name, {'assessment':assessment, 'learner_assessment':learner_assessment,'testing_center':testing_center,'learner_id':learner_id})
		
	def post( self, request, learner_id, qual_id ):
		assessment = AddAssessmentForm(request.POST,prefix="assessment")
		learner_assessment = LearnerAssessment(request.POST,prefix="learner_assessment")
		testing_center = TestingCenterForm(request.POST,prefix="testing_center")
		assessment_name = None
		assessment_type = None
		rating = None
		testing_center_name = None
		testing_center_address = None
		if assessment.is_valid() and learner_assessment.is_valid() and testing_center.is_valid():
			assessment_name = assessment.cleaned_data['assessment_name']
			assessment_type = assessment.cleaned_data['assessment_type']
			assessment.save()
			a_id = Assessment.objects.last()
			
			testing_center_name = testing_center.cleaned_data['testing_center_name']
			testing_center_address = testing_center.cleaned_data['testing_center_address']
			testing_center.save()
			t_id = TestingCenter.objects.last()
			
			rating = learner_assessment.cleaned_data['rating']
			temp = learner_assessment.save(commit=False)
			temp.qualification_id = qual_id
			temp.qualification_type = getattr(Qualification.objects.last(),'qualification_type')
			temp.learner_id = Learner.objects.get(learner_id=learner_id)
			temp.testing_center_id = t_id
			temp.assessment_id = a_id
			temp.save()
			
			assessment = AddAssessmentForm(prefix="assessment")
			learner_assessment = LearnerAssessment(prefix="learner_assessment")
			testing_center = TestingCenterForm(prefix="testing_center")
			return redirect('home-view')
		args = {'assessment':assessment, 'learner_assessment':learner_assessment,'testing_center':testing_center,'learner_id':learner_id,'learner_id':learner_id}
		return render(request,self.template_name,args)

class AddSectionView(TemplateView):
	template_name = 'studentdb/add_section.html'
	
	def get(self, request, year_id):
		add_section = AddSection(prefix="add_section")
		return render(request, self.template_name, {'add_section': add_section})
	
	def post(self, request, year_id):
		add_section = AddSection(request.POST, prefix="add_section")
		section_name = None
		adviser_id = None
		if add_section.is_valid():
			section_name = add_section.cleaned_data['section_name']
			adviser_id = add_section.cleaned_data['adviser_id']
			temp = add_section.save(commit=False)
			temp.year_id = SchoolYear.objects.get(year_id=year_id)
			temp.save()
			return redirect('view-section-list', year_id)
		
		args = {'add_section': add_section, 'section_name': section_name, 'year_id': year_id, 'adviser_id': adviser_id}
		return render(request,self.template_name,args)

class AddAdviserView(TemplateView):
	template_name = 'studentdb/add_adviser.html'

	def get(self, request):
		add_adviser = AddAdviser(prefix="add_adviser")
		return render(request, self.template_name, {'add_adviser': add_adviser})
	
	def post(self, request):
		add_adviser = AddAdviser(request.POST, prefix="add_adviser")
		first_name = None
		last_name = None
		name_extension = None
		middle_name = None
		if add_adviser.is_valid():
			first_name = add_adviser.cleaned_data['first_name']
			last_name = add_adviser.cleaned_data['last_name']
			name_extension = add_adviser.cleaned_data['name_extension']
			middle_name = add_adviser.cleaned_data['middle_name']
			add_adviser.save()
			return redirect('view-school-years')

		args = {'add_adviser': add_adviser, 'first_name': first_name, 'last_name': last_name, 'name_extension': name_extension, 'middle_name': middle_name}
		return render(request,self.template_name,args)

class BatchStudentUpload(TemplateView):
	template_name = 'studentdb/batch_student_upload.html'

class EditFiles(TemplateView):
	template_name = 'studentdb/edit_files.html'

class EditSchoolYear(TemplateView):
	template_name = 'studentdb/edit_school_year.html'
	
class GeneratedId(TemplateView):
	template_name = 'studentdb/generated_id.html'

class HomeView(TemplateView):
    template_name = 'studentdb/home.html'

class AddStudentWID(TemplateView):
	template_name = 'studentdb/known_id.html'

class AddStudentWLRN(TemplateView):
    template_name = 'studentdb/known_lrn.html'

class LoginView(TemplateView):
    template_name = 'studentdb/login.html'

class UpdateStudentRecord(TemplateView):
	template_name = 'studentdb/update_student.html'

class VerifyLRN(TemplateView):
	template_name = 'studentdb/verify_lrn.html'

class ViewSchoolYears(ListView):
	template_name = 'studentdb/view_school_years.html'
	paginate_by = 20
	ordering = ['year_start']
	queryset = SchoolYear.objects.all()

# in-between view
def ViewSectionList(request, year_id):
	y_id = SchoolYear.objects.get(year_id=year_id)
	return redirect(reverse('view-section-detail', kwargs={"year_id":getattr(y_id,'year_id')}))

class ViewSectionListDetail(ListView):
	template_name = 'studentdb/view_section_list.html'
		
	def get(self,request,year_id):
		ordering = ['year_level']
		queryset = Section.objects.filter(year_id=year_id)
		year_start = SchoolYear.objects.values('year_start').get(year_id=year_id)['year_start'];
		year_end = SchoolYear.objects.values('year_end').get(year_id=year_id)['year_end']
		year_level = SchoolYear.objects.values('year_level').get(year_id=year_id)['year_level']
		print(queryset)
		return render(request, self.template_name, {'year_id':year_id,'year_start':year_start, 'year_end':year_end,'year_level':year_level,'queryset':queryset})

class ViewSection(TemplateView):
	template_name = 'studentdb/view_section.html'
	
# in-between view
def ViewStudent(request, learner_id):
	l_id = Learner.objects.get(learner_id=learner_id)
	return redirect(reverse('view-student-details', kwargs={"learner_id":getattr(l_id,'learner_id')}))
	
class ViewStudentDetail(TemplateView):
	template_name = 'studentdb/view_student.html'
	
	def get( self, request, learner_id ):
		l_id = learner_id
		lrn = Learner.objects.values('lrn').get(learner_id=l_id)['lrn']
		last_name = Learner.objects.values('last_name').get(learner_id=l_id)['last_name']
		first_name = Learner.objects.values('first_name').get(learner_id=l_id)['first_name']
		middle_name = Learner.objects.values('middle_name').get(learner_id=l_id)['middle_name']
		name_extension = Learner.objects.values('name_extension').get(learner_id=l_id)['name_extension']
		status = Learner.objects.values('status').get(learner_id=l_id)['status']
		sex = Learner.objects.values('sex').get(learner_id=l_id)['sex']
		date_of_birth = Learner.objects.values('date_of_birth').get(learner_id=l_id)['date_of_birth']
		qualification_type = Qualification.objects.values('qualification_type').get(learner_id=l_id)['qualification_type']
		q_id = Qualification.objects.values('qualification_id').get(learner_id=learner_id)['qualification_id']
		q_string = None
		args = {}
		if( qualification_type == 'E' ):
			q_string = 'Completed Elementary School'
			average = ElementaryDiploma.objects.values('general_average').get(qualification_id=q_id)['general_average']
			s_id = ElementaryDiploma.objects.values('school_id').get(qualification_id=q_id)['school_id']
			school_name = ElementarySchool.objects.values('school_name').get(school_id=s_id)['school_name']
			school_address = ElementarySchool.objects.values('school_address').get(school_id=s_id)['school_address']
			
			args = { 'learner_id':learner_id,'lrn':lrn, 'last_name':last_name, 'first_name':first_name, 'middle_name':middle_name, 'name_extension':name_extension, 'status':status, 'date_of_birth':date_of_birth, 'sex':sex, 'qualification_type':q_string, 'average':average,'school_name':school_name, 'school_address':school_address}
		else:
			q_string = 'Passed Assessment'
			rating = LearnerAssessmentModel.objects.values('rating').get(qualification_id=q_id)['rating']
			
			t_id = LearnerAssessmentModel.objects.values('testing_center_id').get(qualification_id=q_id)['testing_center_id']
			t_name = TestingCenter.objects.values('testing_center_name').get(testing_center_id=t_id)['testing_center_name']
			t_address = TestingCenter.objects.values('testing_center_address').get(testing_center_id=t_id)['testing_center_address']
			
			a_id = LearnerAssessmentModel.objects.values('assessment_id').get(qualification_id=q_id)['assessment_id']
			a_type = Assessment.objects.values('assessment_type').get(assessment_id=a_id)['assessment_type']
			a_name = None
			if( a_type == 'P'):
				a_name = 'PEPT'
			elif( a_type == 'A' ):
				a_name = 'ALS A&E'
			else:
				a_name = Assessment.objects.values('assessment_name').get(assessment_id=a_id)['assessment_name']
				
			args = { 'learner_id':learner_id,'lrn':lrn, 'last_name':last_name, 'first_name':first_name, 'middle_name':middle_name, 'name_extension':name_extension, 'status':status, 'qualification_type':q_string, 'date_of_birth':date_of_birth, 'sex':sex, 't_name':t_name, 't_address':t_address, 'a_type':a_type, 'a_name':a_name }
		return render(request, self.template_name, args)

class ViewStudentRecords(ListView):
	template_name = 'studentdb/view_student_records.html'
	paginate_by = 20
	ordering = ['last_name']
	queryset = Learner.objects.all()

# For registering accounts, low priority
# def register(request):
	# if request.method == 'POST':
		# form = UserCreationForm(request.POST)
		# if form.is_valid():
			# form.save()
			# return redirect('/account')
	# else:
		# form = UserCreationForm()
		
		# args = {'form':form}
		# return render(request, 'studentdb/register.html')