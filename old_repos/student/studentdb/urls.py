from django.urls import path
from . import views
from studentdb.views import *
urlpatterns = [
	path('', views.LoginView.as_view(), name='login'),
	path('home/', views.HomeView.as_view(), name='home-view'),
	path('create-student-record/', views.CreateStudentView.as_view(), name='create-student-view'),
	path('create-student-record/add-eligibility/<int:learner_id>/<int:qual_id>', views.AddEligibility.as_view(), name='add-eligibility'),
	path('create-student-record/add-assessment/<int:learner_id>/<int:qual_id>', views.AddAssessment.as_view(), name='add-assessment'),
	
	path('view-school-years/', views.ViewSchoolYears.as_view(), name='view-school-years'),
	path('view-school-years/view-sections/<int:year_id>/', ViewSectionList, name='view-section-list'), # in-between
	path('view-school-years/view-sections/<int:year_id>/detail', views.ViewSectionListDetail.as_view(), name='view-section-detail'),
	path('view-school-years/view-sections/<int:year_id>/detail/view-class/<int:section_id>/', views.ViewSectionListDetail.as_view(), name='view-class-list'), # in-between
	path('view-school-years/view-sections/<int:year_id>/detail/view-class/<int:section_id>/detail', views.ViewSectionListDetail.as_view(), name='view-class-list'),
	
	path('view-school-years/view-sections/add-adviser/', views.AddAdviserView.as_view(), name='add-adviser'),
	path('view-school-years/view-sections/<int:year_id>/add-section/', views.AddSectionView.as_view(), name='add-section'),
	path('view-school-years/add-school-year/', views.AddSchoolYear.as_view(), name='add-school-year'),
	
	path('view-student-records/', views.ViewStudentRecords.as_view(), name='view-student-records'),
	path('view-student-records/<int:learner_id>/', ViewStudent, name='view-student'), # in-between
	path('view-student-records/<int:learner_id>/detail/', views.ViewStudentDetail.as_view(), name='view-student-details'),
]
