from django.contrib import admin
from django.contrib.auth import get_user_model
from django.contrib.auth.admin import UserAdmin

from .forms import CustomUserCreationForm, CustomUserChangeForm
from .models import CustomUser, Subject_t, Class_t, Student_t, Grade_t, SubjTeachA_t

class CustomUserAdmin( UserAdmin ):
	add_form = CustomUserCreationForm
	form = CustomUserChangeForm
	model = CustomUser
	list_display = ['username']

# Register your models here.
admin.site.register(Subject_t)
admin.site.register(Class_t)
admin.site.register(Student_t)
admin.site.register(Grade_t)
admin.site.register(SubjTeachA_t)
admin.site.register(CustomUser, CustomUserAdmin)

# admin.site.register(User_t)