# Generated by Django 2.2.1 on 2019-05-18 14:34

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Adviser',
            fields=[
                ('adviser_id', models.AutoField(primary_key=True, serialize=False)),
                ('first_name', models.CharField(max_length=70)),
                ('last_name', models.CharField(max_length=50)),
                ('name_extension', models.CharField(max_length=3, null=True)),
                ('middle_name', models.CharField(max_length=50, null=True)),
            ],
        ),
        migrations.CreateModel(
            name='Assessment',
            fields=[
                ('assessment_id', models.AutoField(primary_key=True, serialize=False)),
                ('assessment_name', models.CharField(max_length=255, null=True)),
                ('assessment_type', models.CharField(choices=[('A', 'ALS A&E'), ('P', 'PEPT'), ('O', 'Other')], max_length=1)),
            ],
        ),
        migrations.CreateModel(
            name='ElementarySchool',
            fields=[
                ('school_id', models.AutoField(primary_key=True, serialize=False)),
                ('school_name', models.CharField(max_length=255)),
                ('school_address', models.CharField(max_length=255)),
            ],
        ),
        migrations.CreateModel(
            name='Learner',
            fields=[
                ('learner_id', models.AutoField(primary_key=True, serialize=False)),
                ('lrn', models.BigIntegerField(null=True)),
                ('first_name', models.CharField(max_length=70)),
                ('last_name', models.CharField(max_length=50)),
                ('name_extension', models.CharField(max_length=3, null=True)),
                ('middle_name', models.CharField(max_length=50, null=True)),
                ('date_of_birth', models.DateField()),
                ('sex', models.CharField(choices=[('M', 'Male'), ('F', 'Female')], max_length=1, null=True)),
                ('status', models.CharField(choices=[('E', 'Currently Enrolled'), ('NE', 'Not Currently Enrolled'), ('ETR', 'Currently Enrolled Transferee'), ('NETR', 'Not Currently Enrolled Transferee'), ('T', 'Transferred')], max_length=4)),
            ],
        ),
        migrations.CreateModel(
            name='Qualification',
            fields=[
                ('qualification_id', models.AutoField(primary_key=True, serialize=False)),
                ('qualification_type', models.CharField(choices=[('A', 'Assessment'), ('E', 'Elementary Diploma')], max_length=1)),
                ('learner_id', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='studentdb.Learner')),
            ],
        ),
        migrations.CreateModel(
            name='SchoolYear',
            fields=[
                ('year_id', models.IntegerField(primary_key=True, serialize=False)),
                ('year_start', models.CharField(max_length=4)),
                ('year_end', models.CharField(max_length=4)),
                ('year_level', models.IntegerField()),
            ],
        ),
        migrations.CreateModel(
            name='TestingCenter',
            fields=[
                ('testing_center_id', models.AutoField(primary_key=True, serialize=False)),
                ('testing_center_name', models.CharField(max_length=255)),
                ('testing_center_address', models.CharField(max_length=255)),
            ],
        ),
        migrations.CreateModel(
            name='User',
            fields=[
                ('account_id', models.AutoField(primary_key=True, serialize=False)),
                ('first_name', models.CharField(max_length=70)),
                ('last_name', models.CharField(max_length=50)),
                ('name_extension', models.CharField(max_length=3, null=True)),
                ('middle_name', models.CharField(max_length=50, null=True)),
                ('username', models.CharField(max_length=255)),
                ('password', models.CharField(max_length=255)),
                ('account_type', models.CharField(choices=[('A', 'Administrator'), ('T', 'Teacher')], max_length=1)),
            ],
        ),
        migrations.CreateModel(
            name='Section',
            fields=[
                ('section_id', models.AutoField(primary_key=True, serialize=False)),
                ('section_name', models.CharField(max_length=50)),
                ('adviser_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.Adviser')),
                ('year_id', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='studentdb.SchoolYear')),
            ],
        ),
        migrations.CreateModel(
            name='LearnerFiles',
            fields=[
                ('file_id', models.AutoField(primary_key=True, serialize=False)),
                ('file_name', models.CharField(max_length=255)),
                ('file_path', models.CharField(max_length=255)),
                ('learner_id', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='studentdb.Learner')),
            ],
        ),
        migrations.CreateModel(
            name='LearnerCitations',
            fields=[
                ('citation_id', models.AutoField(primary_key=True, serialize=False)),
                ('citation', models.CharField(max_length=255)),
            ],
            options={
                'unique_together': {('citation_id', 'citation')},
            },
        ),
        migrations.AddField(
            model_name='learner',
            name='citation_id',
            field=models.ForeignKey(null=True, on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.LearnerCitations'),
        ),
        migrations.CreateModel(
            name='Credential',
            fields=[
                ('credential_id', models.AutoField(primary_key=True, serialize=False)),
                ('credential', models.CharField(max_length=255)),
                ('learner_id', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='studentdb.Learner')),
            ],
        ),
        migrations.CreateModel(
            name='LearnerSection',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('class_number', models.IntegerField()),
                ('learner_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.Learner')),
                ('section_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.Section')),
            ],
            options={
                'unique_together': {('learner_id', 'section_id')},
            },
        ),
        migrations.CreateModel(
            name='LearnerAssessment',
            fields=[
                ('qualification_ptr', models.OneToOneField(auto_created=True, on_delete=django.db.models.deletion.CASCADE, parent_link=True, primary_key=True, serialize=False, to='studentdb.Qualification')),
                ('date', models.DateField()),
                ('rating', models.IntegerField()),
                ('assessment_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.Assessment')),
                ('testing_center_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.TestingCenter')),
            ],
            bases=('studentdb.qualification',),
        ),
        migrations.CreateModel(
            name='ElementaryDiploma',
            fields=[
                ('qualification_ptr', models.OneToOneField(auto_created=True, on_delete=django.db.models.deletion.CASCADE, parent_link=True, primary_key=True, serialize=False, to='studentdb.Qualification')),
                ('general_average', models.DecimalField(decimal_places=2, max_digits=5)),
                ('school_id', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='studentdb.ElementarySchool')),
            ],
            bases=('studentdb.qualification',),
        ),
    ]
