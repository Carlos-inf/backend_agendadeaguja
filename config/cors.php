<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CORS settings
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Permite GET, POST, PUT, DELETE, etc.

    'allowed_origins' => [
        'http://localhost:3000', // Servidor de desarrollo de React
        'http://127.0.0.1:3000', // Alternativa
        'http://127.0.0.1:8000', // Si accedes a la API directamente
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permite todos los encabezados, incluyendo Authorization

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];