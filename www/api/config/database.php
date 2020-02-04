<?php  

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'lessonsg' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_LESSONSSG'),
            'database' => env('DB_DATABASE_LESSONSSG'),
            'username' => env('DB_USERNAME_LESSONSSG'),
            'password' => env('DB_PASSWORD_LESSONSSG'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]
    ]
];