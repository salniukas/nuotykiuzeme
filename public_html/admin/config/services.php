<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'discord' => [
    'client_id' => env('DISCORD_KEY'),
    'client_secret' => env('DISCORD_SECRET'),
    'redirect' => env('DISCORD_REDIRECT_URI'),  
    ],
    'paysera' => [
        'projectid' => env('PAYSERA_ID'),
        'password' => env('PAYSERA_PASS'),
        'accepturl' => 'http://bapserveris.lt/uzsakymas-pavyko',
        'cancelurl' => 'http://bapserveris.lt/uzsakymas-nepavyko',
        'version' => '1.6',
        'test' => env('PAYSERA_TEST'),
    ],

];
