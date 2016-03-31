<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Models\User::class,
        'key'    => '',
        'secret' => '',
    ],


    'facebook' => [
        'client_id' => '891953757524117',
        'client_secret' => '31462c4a376f9473c23d19134b2edd76',
        'redirect' => 'http://localhost:8000'.'/login/facebook/callback',
    ],

    'google'=>[
        'client_id' => '105971898052-0lbb20naehruabb5t2ppn837nhk5hnuj.apps.googleusercontent.com',
        'client_secret' => '4Zzhrkx0PUHg9MQ5ueiZ1mS6',
        'redirect' => 'http://localhost:8000'.'/login/google/callback',
    ],

    // 'facebook' => [
    //     'client_id' => '891953757524117',
    //     'client_secret' => '31462c4a376f9473c23d19134b2edd76',
    //     'redirect' => 'http://localhost:8000/auth/facebook/callback',
    // ],
    // 'google'=>[
    //     'client_id' => '105971898052-0lbb20naehruabb5t2ppn837nhk5hnuj.apps.googleusercontent.com',
    //     'client_secret' => '4Zzhrkx0PUHg9MQ5ueiZ1mS6',
    //     'redirect' => 'http://localhost:8000/auth/google/callback',
    // ]

];
