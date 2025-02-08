<?php

return [
    'email' => [
        'confirm_account' => [
            'subject' =>  'Online account confirmation',
            'line_1' => 'Click on the following button to confirm your online account registration.',
            'line_2' => 'If you’re having trouble clicking the button, copy and paste the URL below into your web browser: ',
        ],
        'confirmation_code' =>'Please enter the confirmation code below to confirm your user account',
        'reset_password'=>[
            'subject' => 'Reset password notification',
            'line_1' => 'Your Password Has been reset ,Click a button to login with new password',
        ],
        'passwords' => [
            'line_1' => "Here are your password reset instructions.",
            'line_2' => "A request to reset your password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password:",
            "button" => "Reset Password",
            "line_3" => "If the button above does not work, try copying and pasting the URL into your browser. If you continue to have problems, please feel free to contact us",
            'new' => [
                'line_1' => 'Your New Password is shown below ,Click a button to login with new password'
            ]
        ],
    ],
    'sms' => [
        'registered' => 'Your online user account has been registered, please use the confirmation code to complete your registration. Your Confirmation Code for user account is ',
        'confirmation_code' => 'Your Confirmation Code for user account is '
    ],
    'application' => [
        'status' => 'Click button below to view your application status',
    ],


];
