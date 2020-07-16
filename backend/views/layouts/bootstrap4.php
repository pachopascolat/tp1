<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use backend\assets\BootstrapVueAsset;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

BootstrapVueAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
    ]);


    $categorias_padre = common\models\Categoria::find()->where(['categoria_padre' => null])->all();
    foreach ($categorias_padre as $cat) {
        $items_hijo = [];
        /*                @var $cat common\models\Categoria */
        foreach ($cat->categorias as $hijo) {
            $items_hijo[] = ['label' => $hijo->nombre_categoria, 'url' => ['/vidriera/index', 'categoria_id' => $hijo->id_categoria]];
        }
        $items_padre['items'][] = [
            'label' => $cat->nombre_categoria,
            'items' => $items_hijo,
            'url' => ['/vidriera/index', 'categoria_id' => $cat->id_categoria],
        ];
    }
    $items_padre['label'] = 'Vidrieras';

    $menuItems = [
        $items_padre,
        ['label' => 'PDF', 'items' => [
            ['label' => 'crear', 'url' => ['/pdf-report/create-vidriera-pdf']],
            ['label' => 'descargar', 'url' => ['/pdf-report/index']],
        ]
        ],
        ['label' => 'Usuarios', 'url' => ['/usuarios']],
        ['label' => 'Stock', 'items' => [
            ['label' => 'Articulos', 'url' => ['/articulo/index']],
            ['label' => 'Telas', 'url' => ['/tela/index']],
        ]
        ],
        ['label' => 'Categorias', 'items' => [
            ['label' => 'Hogar', 'url' => ['/categoria/index', 'categoria_padre' => 1]],
            ['label' => 'Moda', 'url' => ['/categoria/index', 'categoria_padre' => 2]],
            ['label' => 'Otras', 'url' => ['/categoria/index', 'categoria_padre' => -1 ]],
        ]
        ],
//        ['label' => 'Consultas', 'url' => ['/carrito/index', 'categoria_padre' => 2]],
        ['label' => 'Pedidos', 'url' => ['/estado-pedido/index']],
        ['label' => 'frontend', 'url' => Yii::$app->urlManagerFrontEnd->baseUrl, 'linkOptions' => ['target' => '_blank'],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
//                $menuItems[] = ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/security/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }



    echo Nav::widget([
        'options' => [
            'class' => 'navbar navbar-nav w-100 justify-content-end',
        ],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
<!--        <p class="pull-left">&copy; Desarrollado por Patricio Pascolat para Colegio Nueva Generación --><?//= date('Y') ?><!--</p>-->

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
