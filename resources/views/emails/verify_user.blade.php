<!DOCTYPE html>
<html>
<head>
    <title>Verify your email</title>
</head>

<body>
<br/>
Dear {{ $user->name }},
<br>
Please click the link below. You won’t be asked to log in as its simply a verification of the ownership of this email address.
<br/>
<a href="{{ route('email.verify', $user->verification_token) }}">Verify Email</a>
</body>

</html>