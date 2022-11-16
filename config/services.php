<?php
#$jsonGoogleData = readGoogleJsonData();
#$dbGoogleJson = (!empty($jsonGoogleData->socialGoogleData))?$jsonGoogleData->socialGoogleData:'';
#$jsonFacebookData = readFacebookJsonData();
#$dbFacebookJson = (!empty($jsonGoogleData->socialFacebookData))?$jsonGoogleData->socialFacebookData:'';
return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
	'google' => [
    'client_id'     => (!empty($dbGoogleJson->GOOGLE_CLIENT_ID))?$dbGoogleJson->GOOGLE_CLIENT_ID:env('GOOGLE_CLIENT_ID'),
    'client_secret' => (!empty($dbGoogleJson->GOOGLE_CLIENT_SECRET))?$dbGoogleJson->GOOGLE_CLIENT_SECRET:env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => (!empty($dbGoogleJson->GOOGLE_REDIRECT))?$dbGoogleJson->GOOGLE_REDIRECT:env('GOOGLE_REDIRECT')
	],
	'facebook' => [
        'client_id' => (!empty($dbFacebookJson->FACEBOOK_CLIENT_ID))?$dbFacebookJson->FACEBOOK_CLIENT_ID:env('FACEBOOK_CLIENT_ID'),
        'client_secret' => (!empty($dbFacebookJson->FACEBOOK_CLIENT_SECRET))?$dbFacebookJson->FACEBOOK_CLIENT_SECRET:env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => (!empty($dbFacebookJson->FACEBOOK_CALLBACK_URL))?$dbFacebookJson->FACEBOOK_CALLBACK_URL:env('FACEBOOK_CALLBACK_URL')
    ],



'stripe' => [
    'free' => 'free',
    'six_monthly' => 'price_1JNuV8H2CH1zy3TlSv2Ikgy0',//'price_1IVtmlH2CH1zy3TlsWan0ZEv',
    'twelve_monthly' => 'price_1JNuVZH2CH1zy3TlsNi5RO1p',
],
    'commission_percentage' => [
        '0' => 20,
        '1' => 25,
        '2' => 30
    ]
];
