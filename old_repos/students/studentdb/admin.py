from django.contrib import admin
from .models import Learner, Credential

# This means administrators can modify the models below
admin.site.register(Learner)
admin.site.register(Credential)