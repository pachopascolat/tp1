<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'language' => 'es', // spanish
    'defaultRoute' => 'texsim/index',
    'id' => 'app-frontend',
    'homeUrl' => '/',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'controllerMap' => [
                'security' => 'frontend\controllers\SecurityController',
//                'user' => 'frontend\controllers\SecurityController',
            ],
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => "",
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'texsim/index',
                'hogar' => 'texsim/hogar',
                'moda' => 'texsim/moda',
                'categoria' => 'texsim/por-categoria',
                
//                'texsim/categorias'=>'texsim/designs',
//                'texsim/estampados' => 'texsim/designs',
                'designs' => 'texsim/categorias',
                '<id:\d+>-<nombre_tela:[^/]+>' => 'texsim/categorias',
//                '<nombre:\w+>' => 'design',
                'agregar-items' => 'texsim/agregar-items',
                'carrito' => 'texsim/carrito',
                'delete-item' => 'texsim/delete-item',
                'aumentar-cantidad' => 'texsim/aumentar-cantidad',
                'disminuir-cantidad' => 'texsim/disminuir-cantidad',
                'cambiar-precio' => 'texsim/cambiar-precio',
                'delete-carrito' => 'texsim/delete-carrito',
                'agregar-item' => 'texsim/agregar-item',
                'contacto' => 'texsim/contacto',
                'crear-consulta' => 'texsim/crear-consulta',
                'pedido-facturacion' => 'texsim/pedido-facturacion',
                'crear-consulta-whats-app' => 'texsim/crear-consulta-whats-app',
                'ir-whats-app' => 'texsim/ir-whats-app',
                'finalizar-consulta' => 'texsim/finalizar-consulta',
                'login' => 'security/login',
//                '<module:user>/login' => 'security/login',
                
                'logout' => 'security/logout',
                'nuevo-pedido' => 'texsim/nuevo-pedido',
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:user>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
        'urlManagerBackEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        "js/jquery-3.3.1.min.js",
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        "js/bootstrap.min.js",
                    ],
//                    'css' => [
//                        'css/bootstrap.css',
//                        'css/agency.css'
//                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
