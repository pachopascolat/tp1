<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
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
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
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
//                ['label' => 'Home', 'url' => ['/site/index']],
//                ['label' => 'Ofertas', 'url' => ['/gallery-image/index', 'categoria_padre' => 1]],
                $items_padre
//                    , 'items' => [
//                        ['label' => 'Hogar', 'url' => ['/vidriera/index', 'categoria' => 'Hogar']],
//                        ['label' => 'Moda', 'url' => ['/vidriera/index', 'categoria' => 'Moda']],
////                        ['label' => 'PDF', 'url' => ['/vidriera/index','categoria'=>'PDF']],
//                    ]
                ,
//                ['label' => 'Ordenar', 'url' => ['/gallery-image/ordenar-disenios']],
                ['label' => 'PDF', 'items' => [
                        ['label' => 'crear', 'url' => ['/vidriera/create-pdf']],
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
                ['label' => 'Consultas', 'url' => ['/carrito/index', 'categoria_padre' => 2]],
//                ['label' => 'Pedidos', 'url' => ['/carrito/index-pedidos', 'categoria_padre' => 2]],
                ['label' => 'frontend', 'url' => Yii::$app->urlManagerFrontEnd->baseUrl, 'linkOptions' => ['target' => '_blank'],
                ],
//                ['label' => 'Hogar', 'items' => [
//                        ['label' => 'Categorias', 'url' => ['/categoria/index','categoria_padre'=>1]],
//                        ['label' => 'Telas', 'url' => ['/tela/index', 'categoria_padre' => 1]],
//                    ],
//                ],
//                ['label' => 'Moda', 'items' => [
//                        ['label' => 'Categorias', 'url' => ['/categoria/index','categoria_padre'=>2]],
//                        ['label' => 'Telas', 'url' => ['/tela/index', 'categoria_padre' => 2]],
//                    ],
//                ],
//                ['label' => 'Moda', 'url' => ['/categoria/moda']],
//                ['label' => 'Telas', 'url' => ['/tela/index']],
//                ['label' => 'Diseños', 'url' => ['/disenio/index']],
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
                'options' => ['class' => 'navbar-nav navbar-right'],
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
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
