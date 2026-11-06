<?php

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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT_URL'),
    ],

    'shippo' => [
        'key' => env('SHIPPO_API_KEY')
    ],

    'usps' => [
        'base_url' => env('USPS_BASE_URL', 'https://apis.usps.com'),
        'consumer_key' => env('USPS_CONSUMER_KEY'),
        'consumer_secret' => env('USPS_CONSUMER_SECRET'),
        'origin_zip' => env('USPS_ORIGIN_ZIP', '94901'),
    ],

    'inventory_api' => [
        'base_url' => env('INVENTORY_API_BASE_URL', 'http://localhost/Encorecustom_ecomerce/api/v1'),
        'api_key' => env('INVENTORY_API_KEY', 'inventory_products_api'),
        'api_token' => env('INVENTORY_API_TOKEN', '0VpFn7U9tzzhRpfLO2bLRdIoFyVoFe7BBZA68vTK'),
        'inventory_type_id' => env('INVENTORY_API_INVENTORY_TYPE_ID', 2),
        'sales_channel_id' => env('INVENTORY_API_SALES_CHANNEL_ID', 1),
    ],

];

