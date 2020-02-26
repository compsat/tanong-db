from django.contrib import admin
from django.urls import include, path

from database.views import student_form_view

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', include('database.urls')),
    path('createstudent/', student_form_view),
]
