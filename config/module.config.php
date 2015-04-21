<?php
return [
    'AxosoftApi' => [
        'Connection' => [
            'base_url' => 'https://mysubdomain.axosoft.com',
        ],

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
            'AxosoftApi\Service\AxosoftApi'
            => 'AxosoftApi\Factory\AxosoftApiServiceFactory',
            'AxosoftApi\Service\HttpClient'
            => 'AxosoftApi\Factory\GuzzleHttpClientFactory',
            'AxosoftApi\Grant\ApiRequest'
            => 'AxosoftApi\Factory\UsernamePasswordGrantFactory',
        ],
    ],

    'controllers' => [
        'invokables' => [
            // TESTING
            'AxosoftApi\Controller\IndexController' =>
                'AxosoftApi\Controller\IndexController',
        ]
    ],
//    'router' => [
//        'routes' => [
//            'AxosoftApiTest' => [
//                'type' => 'segment',
//                'options' => [
//                    'route' => '/axosoft-api',
//                    'defaults' => [
//                        'controller' => 'AxosoftApi\Controller\IndexController',
//                        'action' => 'index',
//                    ],
//                ],
//            ],
//        ]
//    ]
];