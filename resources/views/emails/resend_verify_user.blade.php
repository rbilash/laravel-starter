<!DOCTYPE html>
<html>
<head>
    <title>Verify your email</title>
</head>

<body>
    <br/>
    Dear {{ $user->name }},
    <br>
    We are sending this email because you asked to resend verification code for your account. To complete verification, please hit the link below.
    <br/>
    If you didn't asked to resend verification code, please ignore this email and your acount will not be affected.
    <br/>
    <a href="{{ route('email.verify', $user->verification_token) }}">Verify Email</a>
</body>

</html>