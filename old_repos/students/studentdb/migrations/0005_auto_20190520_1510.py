# Generated by Django 2.2.1 on 2019-05-20 07:10

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('studentdb', '0004_auto_20190520_1313'),
    ]

    operations = [
        migrations.AlterField(
            model_name='learner',
            name='lrn',
            field=models.CharField(max_length=12, null=True, unique=True),
        ),
    ]