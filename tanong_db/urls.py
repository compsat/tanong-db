from django.contrib import admin
from django.urls import include, path
from database.views import create_student_view

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('database.urls')),
    path('createstudent/', create_student_view),
]
