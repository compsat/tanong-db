from django.contrib import admin
from django.contrib.auth.admin import UserAdmin as DjangoUserAdmin
from django.utils.translation import ugettext_lazy as _
from .models import *
from .forms import AdminAccessCodeAddForm, AdminAccessCodeChangeForm
from .helper_methods import random_code_generator

class SectionInline(admin.TabularInline):
    model = Section

class UserInline(admin.TabularInline):
    model = User
    fields = ('email',)

class StudentInline(admin.TabularInline):
    model = Student

class GradeInline(admin.TabularInline):
    model = Grade

# Register your models here.
@admin.register(User)
class UserAdmin(DjangoUserAdmin):
    """Define admin model for custom User model with no email field."""

    fieldsets = (
        (None, {'fields': ('email', 'password', 'access_object')}),
        (_('Personal info'), {'fields': ('first_name', 'last_name')}),
        (_('Permissions'), {'fields': ('is_active', 'is_staff', 'is_superuser',
                                       'groups', 'user_permissions')}),
        (_('Important dates'), {'fields': ('last_login', 'date_joined')}),
    )
    add_fieldsets = (
        (None, {
            'classes': ('wide',),
            'fields': ('email', 'password1', 'password2'),
        }),
    )
    list_display = ('email', 'first_name', 'last_name','is_staff', 'is_active', 'section')
    search_fields = ('email', 'first_name', 'last_name',)
    ordering = ('last_name',)
    inlines = [SectionInline]

    def section(self, x):
        if x.section:
            return x.section

class AccessCodeAdmin(admin.ModelAdmin):
    list_display = ('code', 'user')
    inlines = []

    def user(self, x):
        return x.user
    user.short_description = 'user'

    def add_view(self, request, extra_content=None):
        self.form = AdminAccessCodeAddForm
        self.inlines = []
        return super(AccessCodeAdmin, self).add_view(request)   

    def change_view(self, request, object_id, extra_content=None):
        self.form = AdminAccessCodeChangeForm
        self.inlines = [UserInline]
        return super(AccessCodeAdmin, self).change_view(request, object_id)

    def save_model(self, request, obj, form, change):
        quantity = form.cleaned_data.get('quantity')
        for x in range(0, quantity):
            obj.code = random_code_generator(5)
            super(AccessCodeAdmin, self).save_model(request, obj, form, change)
            if x != (quantity-1):
                obj = AccessCode.objects.create()

class SectionAdmin(admin.ModelAdmin):
    list_display = ('year_level', 'name', 'adviser',)
    list_filter = ('adviser', 'year_level')
    ordering = ('year_level', 'name')
    inlines = [StudentInline]

class StudentAdmin(admin.ModelAdmin):
    list_display = ('last_name', 'first_name', 'section',)
    list_filter = ('section',)
    ordering = ('last_name',)
    inlines = [GradeInline]

admin.site.register(AccessCode, AccessCodeAdmin)
admin.site.register(Grade)
admin.site.register(Section, SectionAdmin)
admin.site.register(Student, StudentAdmin)
admin.site.register(Subject)
