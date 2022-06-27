<?php

// SSLCommerz configuration
if(config('app.env') == 'production'){
    return [
        'projectPath' => env('PROJECT_PATH', 'https://cinebaz.com'),
        'apiDomain' => "https://securepay.sslcommerz.com",
        'apiCredentials' => [
            'store_id' =>  'cinebazlive',
            'store_password' =>  '61CD82976878479959',
        ],
        'apiUrl' => [
            'make_payment' => "/gwprocess/v4/api.php",
            'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
            'order_validate' => "/validator/api/validationserverAPI.php",
            'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
            'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        ],
        'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
        'success_url' => '/success',
        'failed_url' => '/fail',
        'cancel_url' => '/cancel',
        'ipn_url' => '/ipn',
    ];
}else{
    return [
        'projectPath' => env('PROJECT_PATH', 'http://103.92.206.35:6060/cinebaz'),

        'apiDomain' => env("API_DOMAIN_URL", "https://sandbox.sslcommerz.com"),
        'apiCredentials' => [
            'store_id' =>  'luova606b444458c9c',
            'store_password' => 'luova606b444458c9c@ssl',
        ],
        'apiUrl' => [
            'make_payment' => "/gwprocess/v4/api.php",
            'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
            'order_validate' => "/validator/api/validationserverAPI.php",
            'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
            'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        ],
        'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
        'success_url' => '/success',
        'failed_url' => '/fail',
        'cancel_url' => '/cancel',
        'ipn_url' => '/ipn',
    ];
}





// PROJECT_PATH=
// API_DOMAIN_URL=
// STORE_ID=
// STORE_PASSWORD=
// IS_LOCALHOST=
