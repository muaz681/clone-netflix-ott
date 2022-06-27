<?php

return [

    'projectPath' => env('APP_URL', 'https://dev2.cinebaz.com'),
    'sandbox' => env("NAGAD_API_SENDBOX", "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs"),
    'live' => env("NAGAD_API_LIVE", "https://api.mynagad.com/api/dfs"),
    'public_key' => env('NAGAD_PUBLIC_KEY', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCWvxDZZesS1g1lQfilVt8l3X5aMbXg5WOCYdG7q5C+Qevw0upm3tyYiKIwzXbqexnPNTHwRU7Ul7t8jP6nNVS/jLm35WFy6G9qRyXqMc1dHlwjpYwRNovLc12iTn1C5lCqIfiT+B/O/py1eIwNXgqQf39GDMJ3SesonowWioMJNXm3o80wscLMwjeezYGsyHcrnyYI2LnwfIMTSVN4T92Yy77SmE8xPydcdkgUaFxhK16qCGXMV3mF/VFx67LpZm8Sw3v135hxYX8wG1tCBKlL4psJF4+9vSy4W+8R5ieeqhrvRH+2MKLiKbDnewzKonFLbn2aKNrJefXYY7klaawIDAQAB'),
    'private_key' => env('NAGAD_PRIVATE_KEY', 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCJqmZNuVT4a33UL0cH4w+1X1jzYO4CCWMJ0bMpsEreT4svVZbEOxCn5n2tZ+qM//ZdhOTdrJBeF8zXXZZUw8/pmrfj7UpKHKw+vdkx5zw0YeW5VPF7NCAUBaTmHpGdwCRk1llpoRyOjYxdQUvQt0bL5vNzaMOV0NXvplByVLGMUVKFICYUA2bBSFb0sMFp/0PK5WPlWUwDme1AVoTAetSN1goVwjZyRu9Cv3s1Nl8ohjVqlbWq4Qnf/OTG8f6Fgw75TWJeaBQwLx5AqZgr4JkQR9aMaxgB4fi2+MQ6BY9wsPxb0UYNDH3cSjXNDA/WMMNdggayEtjIC4msFMc3zaXnAgMBAAECggEAO9decRrG3NWc9Mc4US1afrTbra/MxgXejz4ga1a+tLRPBFxoFRS3wMRojSBGzNPW+//wnIuOldgyqst7tY0Iq7sdhG55hI3CMePErfSeLwb/HPjXn36hExMBAyb2lWQYbdzfMRNfnnfZNBBWLHv+wlO6L8iyfEUzOeFJxukZ5Kww2Q3JgAQ9iDWZbmxfzJwyLNwZtYKHb6/6cMuLj6w5g250IroJRxCkqQujPXjCXOl7V5VX8eSM2qXLyJkQKABIMV2Qd2fi/2xK+st+Jj4/sAqW9XZZXYnURGcpAFNm3Xai8Etcy5Xr1BPhrczOu8qeEwgFMAviPPc4B5kboVcQAQKBgQDQxuDBH2nAt7jXEvLhljZAfKis3h16+Zy97bafQlsAChtAcZVk9H2UPXCVXAgi8A0255I6axNPVk4E3ykguNXIAFCubxXGWs3m+SC9l8fSCPD5WMRG5DXKw8zUtwCz2z41qC36RdM9b7SfjJ5Tiw5BgVBOwcUi3ngRI2X28Npw5wKBgQCozdwpz09DuU2iNYNfNRaX0hlJPOW4SfnuQWOdEhNh7NU/PhuZxEsVWB9peAV5orD+gJAsm8hGuvnMSzyaNqN/m2gXBsEi/kqe8/C57MT474X2ANmCgVrtewNE6/BN8+8kYkYUuFFpdJET+NcDdYmnDGCpIPahob60JCuoSMuDAQKBgDd6Uakf9tMePwDv6Rim+N2kApKFJ2JRSCR0MY4abOISzXEPfbpo+aHVvcACx6q5DVnkqUfawjPX5D2JK32lgDF4W/guTqP55zMUSm33EkMu2xH3U5je9ahe5WQ1CPvCK8LIYQdbXKm7sEyhakUa83vWqAd1mDQO1+r99A9tqy5LAoGALLgsxV7IbvaeXIS0wvo7fAkK7d4WNZZTgg0MqMXrIJwvekun4DqicYsg9z32pVy2axYAG/FBQ4uxNbAQ5AHpmpq/HqqJbA3WEvopIfhZzmEWKi/bb7l5L0TRfubKiLxA9HCchEy4NKnO7W2U+LOgvgKHcQbsj7Fb5jlW34Q5dgECgYBBDApWFf8wu6ZOMCfqUmoo65Ce0Ptb1V7n+A2hRa2QdO3bHWv+dus5V+fSB6q4ltMrDJaNauj261cQQTWydxU1QgaYPV0Pj3asFBeFbbzTYaeUvBwhLKt68iTn2EHnMR40NzF/LUp2e2t+qqFKOzCnFhgdBW0k/ZNgoqXyzfU6CQ=='),


    'apiCredentials' => [
        'merchant_id' => env("NAGAD_MERCHENT_ID", '689580950017829'), // Your merchant ID
        'wallet' => env("NAGAD_WALLET", '01958095001'), // Your merchant Wallet number
    ],
    'apiUrl' => [
        'initialize' => "/check-out/initialize/",
        'complete' => "/check-out/complete/",
        'verify' => "/verify/payment/",
        'callback' => "/callback/nagad", // Your callback url
    ],
    'currencyCode' => '050', // payment currency code
    'status' => 'live', //sandbox or live
];
