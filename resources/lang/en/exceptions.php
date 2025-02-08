<?php

return [
    'session_expired' => 'Your session has expired, please log in to continue',
    'token_mismatch' => 'Sorry, we could not verify your request. Please try again or reload this page to continue.',
    'general' => [
        'error' => 'We encountered problems on the previous request, please try again',
        'unauthorized' => 'Unauthorized, session expired. Please log in to continue',
        'date_exceed_today' => 'Date exceed todays date',
        'nothing_to_process'=> 'Nothing to process! Please check!',
        'can_not_delete_foreign_key'=> 'This item has already been referenced, can not be deleted. Foreign key constraint fails!',
        'taken' => 'The :key value is already taken',
        'network_problem' => 'There is a temporary problem!! Please try again later or make sure that you are connected to the internet',
        'owner_restriction' => 'The page you are trying to access is restricted to the only owner',
        'admin_restriction' => 'The page you are trying to access is restricted to administrator',
        'service_capacity' => 'Your company do not have service capacity to add offer on service selected',
    ],
    'auth' => [
        'deactivated' => 'Your account has been deactivated.',
        'deactivated_company' => 'Your company has been deactivated.',
        'password' => [
            'change_mismatch' => 'That is not your old password.',
            'reset_problem' => 'There was a problem resetting your password. Please resend the password reset email.',
        ],
        'confirmation' => [
            'already_confirmed' => 'Your account has already been confirmed, please login using your email',
            'mismatch' => 'Confirmation token is invalid',
            'mismatch_sms' => 'Confirmation Code is invalid',
            'success' => 'Your account has been confirmed',
        ],
    ],

    'workflow' => [
        'user_access_right' => 'You do no have access right to update this level! Please check!'
    ],



];
