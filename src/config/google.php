<?php

return [

        'credentials' => [
            'web' =>
                [
                    'client_id' => env('GOOGLE_CLIENT_ID'),
                    'project_id' => env('PROJECT_ID'),
                    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri' => 'https://oauth2.googleapis.com/token',
                    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uris' => [ env('GOOGLE_DRIVE_CALLBACK')] ,
                    'javascript_origins' => ['http://127.0.0.1:8000']
                ]
        ],

        'token' => [
            'access_token' => '',
            'expires_in' => 3599,
            'refresh_token' => '',
            'scope' => 'https://www.googleapis.com/auth/drive.appdata https://www.googleapis.com/auth/spreadsheets https://www.googleapis.com/auth/drive https://www.googleapis.com/auth/drive.scripts https://www.googleapis.com/auth/drive.file',
            'token_type' => 'Bearer',
            'created' => 1681915024,
        ]

    ];
