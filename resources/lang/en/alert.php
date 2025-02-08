<?php

return [
    'registration' => [
        'registered' => 'Success, your account has been created.',
        'staff' => 'Success, A staff Account has been Created Successfully.',
    ],
    'auth' => [
        'not_confirmed' => 'Sorry, Your account has not been confirmed',
        'confirmation_sent' => 'Confirmation email has been sent to your email address',
        'confirmation_sms' => 'Confirmation Code SMS has been sent to your company phone number or email',
        'change_password' => 'Success, Password has been changed',
        'forbidden' => 'Forbidden',
        'reset_password'=>'Success ,Password has been reset and sent to your email',
        'reset_password_company'=>'Success ,Password reset instructions has been sent to your email',
        'reset_password_success'=>'Password has been reset successfully. Login with the new password',
        'reset_password_user'=>'we couldn\'t find any user with that email',
        'resend_confirmation' => 'Success, Confirmation notifications have been resent.'
    ],

    'user' =>[
        'updated' => 'Success, user information have been updated',
    ],


    'system' => [
        'code' => [
            'updated' => 'Success, Code has been updated.'
        ],
        'code_value' => [
            'created' => 'Success, Code value has been created.',
            'updated' => 'Success, Code value has been updated.',
            'deactivated' => 'Success, Code value has been deactivated.',
            'activated' => 'Success, Code value has been activated.'
        ],
        'sysdef' => [
            'updated' => 'Success, system definition updated',
        ],

        'workflow' => [
            'assigned' => 'Success, Selected workflow has been assigned to you',
            'updated' => 'Success, workflow has been updated',
        ],

        'document' => [
            'attached' => 'Success, Document Attached',
            'updated' => 'Success, Document updated',
            'removed' => 'Success, Document has been removed',
            'doc_not_selected_for_edit' => 'Select document you wish to edit to proceed!'


        ]

    ],

    'general' => [
        'created' => 'Success, Entry has been created.',
        'updated' => 'Success, Entry has been updated',
        'deleted' => 'Success, Entry has been deleted',
        'activated' => 'Success, Entry has been activated',
        'deactivated' => 'Success, Entry has been deactivated',


        'alert' =>[
            'delete' => 'Are you sure you want to delete this entry?',
            'activate' => 'Are you sure you want to activate this entry?',
            'deactivate' => 'Are you sure you want to deactivate this entry?',

        ]
    ]

];
