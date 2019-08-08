from django.urls import path
from . import views
from subjectdb.views import TestView

urlpatterns = [
	path('', views.index, name='index'),
	path('login/', views.login, name='login'),
	path('adminlanding/', views.adminlanding, name='adminlanding'),
	path('teacherlanding/', views.teacherlanding, name='teacherlanding'),
	path('subjects/', views.subjects, name='subjects'),
	path('yearlevel/', views.yearlevel, name='yearlevel'),
	path('teachermanagement/', views.teachermanagement, name='teachermanagement'),
	path('test/', TestView.as_view(), name='test'),
]