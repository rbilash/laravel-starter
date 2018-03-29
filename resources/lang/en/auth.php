<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'wrongCredentials' => 'We can not find an account with credentials you have entered. Please check your email and password and try again.',

    'forms' => [
        'newUser' => 'New user',
        'name' => 'Name',
        'emailAddress' => 'E-Mail Address',
        'password' => 'Password',
        'confirmPassword' => 'Confirm Password',
        'registerBtn' => 'Register',
        'login' => 'Login',
        'loginBtn' => 'Login',
        'rememberMe' => 'Remember me',
        'forgotPassword' => 'Forgot password?',
        'reset' => 'Reset Password',
        'resetBtn' => 'Reset Password',
        'sendResetBtn' => 'Send Password Reset Link',
        'sendVerification' => 'Send Verification Code',
        'sendVerificationBtn' => 'Send Verification Code',


    ],

    'verificationSent' => 'We have sent you the activation code. Please check your email and click on the link to verify.',
    'verified' => 'You have successfully verified your email address. You may login now.',
    'alreadyVerified' => 'Account already verified. You may login now.',
    'errorVerified' => 'Verification code is invalid or expired. You may resend verification code <a href=":link">here</a>.',
    'notVerified' => 'Please verify your email before logging in. Verification email was sent you upon registration. If you did not receive verification email, you can resend it <a href=":link">here</a>.',

];
