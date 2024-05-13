<?php
namespace L5Swagger\Exceptions\L5SwaggerException;

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
            ],

            'routes' => [
                /*
                 * Route for accessing api documentation interface
                 */
                'api' => 'api/documentation',
            ],

            'paths' => [
                /*
                 * Absolute paths to directory containing the swagger annotations are stored.
                 */
                'annotations' => [
                    base_path('app'),
                ],
                'docs' => storage_path('api-docs')
            ],

            // Reste de la configuration...

        ],
    ],
    'defaults' => [
        'routes' => [
            /*
             * Route for accessing parsed swagger annotations.
             */
            'docs' => 'docs',

            // Modifier la route pour Swagger UI
            'api' => 'swagger', // Nouveau chemin d'accès pour Swagger UI

            // Reste de la configuration...
        ],

        // Reste de la configuration...
    ],
];

