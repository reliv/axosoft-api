<?php
return [
    'Reliv\AxosoftApi' => [

        /**
         * For testing, should be false in production
         */
        'AllowTest' => false,

        /*
         * Connection settings
         */
        'Connection' => [
            'base_url' => 'https://mysubdomain.axosoft.com',
        ],

        /**
         * Connection credentials
         */
        'UsernamePasswordGrant' => [
            'clientId' => 'my-client_id',
            'clientSecret' => 'my-client-secret',
            'username' => 'username',
            'password' => 'password',
            'scope' => 'read write',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Reliv\AxosoftApi\Service\AxosoftApi'
            => 'Reliv\AxosoftApi\Factory\AxosoftApiServiceFactory',
            'Reliv\AxosoftApi\Service\HttpClient'
            => 'Reliv\AxosoftApi\Factory\GuzzleHttpClientFactory',
            'Reliv\AxosoftApi\Grant\ApiRequest'
            => 'Reliv\AxosoftApi\Factory\UsernamePasswordGrantFactory',
        ],
    ],

    /* TESTING ONLY */
    'controllers' => [
        'invokables' => [
            'Reliv\AxosoftApi\Controller\IndexController' =>
                'Reliv\AxosoftApi\Controller\IndexController',
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'AxosoftApiReadTest' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/axosoft-api/read-test',
                    'defaults' => [
                        'controller' => 'Reliv\AxosoftApi\Controller\IndexController',
                        'action' => 'readTest',
                    ],
                ],
            ],
            'AxosoftApiWriteTest' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/axosoft-api/write-test',
                    'defaults' => [
                        'controller' => 'Reliv\AxosoftApi\Controller\IndexController',
                        'action' => 'writeTest',
                    ],
                ],
            ],
        ]
    ]
    /* */
];