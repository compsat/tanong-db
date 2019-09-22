from django.contrib import admin
from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('register/', views.register, name='register'),
    path('register/confirm_reg/',views.confirm, name='conf_reg'),
    path('students/', views.StudentOutput, name = 'StudentOutput'),
    path('students/add/', views.AddStudent, name = 'AddStudent'),
    path('students/<int:pk>/', views.StudentInfo, name = 'StudentInfo'),
    path('students/edit/<int:pk>/', views.EditStudent, name = 'EditStudent'),
    path('grades/<int:student_id>/', views.GradesOutput, name = 'GradesOutput'),
    path('grades/add/<int:student_id>/', views.addGrades, name = 'addGrades'),
    path('grades/edit/<int:student_id>/', views.editGrades, name = 'editGrades')
]
