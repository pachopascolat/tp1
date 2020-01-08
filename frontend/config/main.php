<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'language' => 'es', // spanish
    'defaultRoute' => 'sitio/index',
    'id' => 'app-frontend',
    'homeUrl' => '/',
    'basePath' => dirname(__DIR__),
    'bootstrap'    => ['assetsAutoCompress'],
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
        'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,
            'readFileTimeout' => 3, //Time in seconds for reading each asset file
            'jsCompress' => true, //Enable minification js in html code
            'jsCompressFlaggedComments' => true, //Cut comments during processing js
            'cssCompress' => true, //Enable minification css in html code
            'cssFileCompile' => true, //Turning association css files
            'cssFileRemouteCompile' => false, //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress' => true, //Enable compression and processing before being stored in the css file
            'cssFileBottom' => false, //Moving down the page css files
            'cssFileBottomLoadOnJs' => false, //Transfer css file down the page and uploading them using js
            'jsFileCompile' => true, //Turning association js files
            'jsFileRemouteCompile' => false, //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress' => true, //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true, //Cut comments during processing js
            'noIncludeJsFilesOnPjax' => true, //Do not connect the js files when all pjax requests
            'htmlFormatter' => [
                //Enable compression html
                'class' => '\skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra' => false, //use more compact algorithm
                'noComments' => true, //cut all the html comments
                'maxNumberRows' => 50000, //The maximum number of rows that the formatter runs on
                //or
//                'class' => '\skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',
            //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface
            //or false
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => "",
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'texsim'=>'',
//                '' => 'texsim/index',
//                'hogar' => 'texsim/hogar',
//                'moda' => 'texsim/moda',
//                'categoria' => 'texsim/por-categoria',
//                'buscador' => 'texsim/buscar-telas',
////                'texsim/categorias'=>'texsim/designs',
////                'texsim/estampados' => 'texsim/designs',
//                'designs' => 'texsim/categorias',
//                '<id:\d+>-<nombre_tela:[^/]+>' => 'texsim/categorias',
////                '<nombre:\w+>' => 'design',
//                'agregar-items' => 'texsim/agregar-items',
//                'carrito' => 'texsim/carrito',
//                'delete-item' => 'texsim/delete-item',
//                'aumentar-cantidad' => 'texsim/aumentar-cantidad',
//                'disminuir-cantidad' => 'texsim/disminuir-cantidad',
//                'cambiar-precio' => 'texsim/cambiar-precio',
//                'delete-carrito' => 'texsim/delete-carrito',
//                'agregar-item' => 'texsim/agregar-item',
//                'contacto' => 'texsim/contacto',
//                'crear-consulta' => 'texsim/crear-consulta',
//                'pedido-facturacion' => 'texsim/pedido-facturacion',
//                'crear-consulta-whats-app' => 'texsim/crear-consulta-whats-app',
//                'ir-whats-app' => 'texsim/ir-whats-app',
//                'finalizar-consulta' => 'texsim/finalizar-consulta',
//                'login' => 'security/login',
////                '<module:user>/login' => 'security/login',
//                'logout' => 'security/logout',
//                'nuevo-pedido' => 'texsim/nuevo-pedido',
////                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<module:user>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<action:(.*)>' => 'sitio/<action>',
//                'site/<action:\w+>'=>'sitio/<action:\w+>',
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
            'appendTimestamp' => true,
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
