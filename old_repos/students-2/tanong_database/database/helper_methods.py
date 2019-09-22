import string, secrets, database

"""Generates a string of five randomly generated characters"""
def random_code_generator(length):
    code = ''.join(secrets.choice(string.ascii_uppercase + string.digits) for _ in range(length))

    while database.models.AccessCode.objects.filter(code=code).count() > 0:
        code = ''.join(secrets.choice(string.ascii_uppercase + string.digits) for _ in range(length))
		
    return code