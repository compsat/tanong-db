from django.shortcuts import render

# Create your views here.
def login(request):
 return render(request, 'database/login.html')
def student_list(request):
 return render(request, 'database/student_list.html')