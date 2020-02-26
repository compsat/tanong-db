from django import forms
from .models import Student

class NewStudentForm(forms.ModelForm):
    class Meta:
        model = Student
        fields = ['student_id', 'student_first_name', 'student_middle_name',
                  'student_last_name', 'student_birthdate', 'student_age', 'student_deped_lrd']