# Generated by Django 2.2.1 on 2019-05-19 16:15

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('studentdb', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='learner',
            name='status',
            field=models.CharField(choices=[('E', 'Currently Enrolled'), ('NE', 'Not Currently Enrolled'), ('ETR', 'Currently Enrolled Transferee'), ('NETR', 'Not Currently Enrolled Transferee'), ('T', 'Transferred')], max_length=4, null=True),
        ),
    ]