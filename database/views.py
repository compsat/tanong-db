from django.shortcuts import render
from .forms import NewStudentForm
from .models import Student

# Create your views here.
def student_form_view(request):
    form = NewStudentForm(request.POST or None)
    if form.is_valid():
        form.save()
        form = NewStudentForm()

    context = {
        'form': form
        }

    return render(request, "new_student_form.html", context)    