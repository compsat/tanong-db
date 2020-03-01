from django.urls import path
from database import views
urlpatterns = [
    # path('', )
    path('login/', views.login),
    path('student-list/', views.student_list)
]
