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
            'Reliv\AxosoftApi\Service\AxosoftApi'
            => 'Reliv\AxosoftApi\Factory\AxosoftApiServiceFactory',
            'Reliv\AxosoftApi\Service\HttpClient'
            => 'Reliv\AxosoftApi\Factory\GuzzleHttpClientFactory',
            'Reliv\AxosoftApi\Grant\ApiRequest'
            => 'Reliv\AxosoftApi\Factory\UsernamePasswordGrantFactory',
        ],
    ],

    'controllers' => [
        'invokables' => [
            // TESTING
            'Reliv\AxosoftApi\Controller\IndexController' =>
                'Reliv\AxosoftApi\Controller\IndexController',
        ]
    ],
//    'router' => [
//        'routes' => [
//            'AxosoftApiTest' => [
//                'type' => 'segment',
//                'options' => [
//                    'route' => '/axosoft-api',
//                    'defaults' => [
//                        'controller' => 'Reliv\AxosoftApi\Controller\IndexController',
//                        'action' => 'index',
//                    ],
//                ],
//            ],
//        ]
//    ]
];