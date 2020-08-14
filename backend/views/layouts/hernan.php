<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\BackendAsset;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
//use common\widgets\Alert;

//BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        html,
        body {
            height: 100%;
        }
        body{
            display:flex;
            flex-direction:column;
        }
        footer{
            margin-top:auto;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
        ],
    ]);


    $menuItems = [

        ['label' => 'Nuevo', 'url' => ['/estado-pedido/crear-pedido']],
        ['label' => 'Pedidos', 'url' => ['/estado-pedido/index']],
        ['label' => 'Stock', 'url' => ['/chart/index']],
//        ['label' => 'frontend', 'url' => Yii::$app->urlManagerFrontEnd->baseUrl, 'linkOptions' => ['target' => '_blank'],
//        ],
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

    <div class="container">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => false,
        ])
        ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
