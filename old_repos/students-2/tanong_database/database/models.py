from django.db import models
from django.contrib.auth.models import AbstractUser, BaseUserManager
from django.utils.translation import ugettext_lazy as _

# Create your models here.
class AccessCode(models.Model):
	"""
    Model for access codes given to the advisers for creating an account
    """
	code = models.CharField(max_length=10)

	def __str__(self):
		return self.code

class UserManager(BaseUserManager):
    """Define a model manager for User model with no username field."""

    use_in_migrations = True

    def _create_user(self, email, password, **extra_fields):
        """Create and save a User with the given email and password."""
        if not email:
            raise ValueError('The given email must be set')
        email = self.normalize_email(email)
        user = self.model(email=email, **extra_fields)
        user.set_password(password)
        user.save(using=self._db)
        return user

    def create_user(self, email, password=None, **extra_fields):
        """Create and save a regular User with the given email and password."""
        extra_fields.setdefault('is_staff', False)
        extra_fields.setdefault('is_superuser', False)
        return self._create_user(email, password, **extra_fields)

    def create_superuser(self, email, password, **extra_fields):
        """Create and save a SuperUser with the given email and password."""
        extra_fields.setdefault('is_staff', True)
        extra_fields.setdefault('is_superuser', True)

        if extra_fields.get('is_staff') is not True:
            raise ValueError('Superuser must have is_staff=True.')
        if extra_fields.get('is_superuser') is not True:
            raise ValueError('Superuser must have is_superuser=True.')

        return self._create_user(email, password, **extra_fields)

class User(AbstractUser):
    """User model."""

    username = None
    email = models.EmailField(_('email address'), unique=True)
    first_name = models.CharField(max_length=30)
    last_name = models.CharField(max_length=150)
    access_object = models.OneToOneField(AccessCode, on_delete=models.SET_NULL, null=True, blank=True)
    created_at = models.DateTimeField(auto_now_add=True)

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = []

    objects = UserManager()

    def __str__(self):
        return self.first_name + ' ' + self.last_name

class Section(models.Model):
    """Section model."""
    
    year_level = models.IntegerField()
    name = models.CharField(max_length=50)
    adviser = models.OneToOneField(User, on_delete=models.SET_NULL, null=True, blank=True, related_name='section')

    def __str__(self):
        return str(self.year_level) + '-' + self.name

MALE = 'M'
FEMALE = 'F' 
SEX_CHOICES = ((MALE,'Male'),(FEMALE,'Female'))

class Student(models.Model):
    last_name = models.CharField(max_length=200)
    first_name = models.CharField(max_length=200)
    middle_name = models.CharField(max_length=200,blank=True)
    birth_date = models.DateField()
    LRN = models.IntegerField(blank=True, null=True)
    sex = models.CharField(max_length=1,choices=SEX_CHOICES)
    section = models.ForeignKey(Section, on_delete=models.DO_NOTHING, related_name='student_list')

    @property
    def full_name(self):
        return self.first_name + ' ' + self.last_name

    def __str__(self):
        return self.full_name

class Subject(models.Model):
    name = models.CharField(max_length=100)

    def __str__(self):
        return self.name
    
class Grade(models.Model):
    student = models.ForeignKey(Student, on_delete=models.CASCADE, related_name='grades')
    subject = models.ForeignKey(Subject, on_delete=models.DO_NOTHING)
    firstQ_mark = models.IntegerField()
    secondQ_mark = models.IntegerField()
    thirdQ_mark = models.IntegerField()
    fourthQ_mark = models.IntegerField()

    @property
    def average(self):
        return int((self.firstQ_mark + self.secondQ_mark + self.thirdQ_mark + self.firstQ_mark) / 4)

    @property
    def remarks(self):
        if self.average >= 75:
            return 'PASSED'

        return 'FAILED'

    def __str__(self):
        return self.student.full_name + ' - ' + self.subject.name
    