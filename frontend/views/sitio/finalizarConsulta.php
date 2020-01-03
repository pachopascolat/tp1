        <!-- Hero Section-->
<!--        <section class="hero">
            <div class="container">
                 Breadcrumbs 
                <ol class="breadcrumb justify-content-left">
                    <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Consulta Registrada   </li>
                </ol>
                 Hero Content

            </div>
        </section>-->
        <section class="pb-5">
            <div class="container text-center">
<!--                <hr>
                <div class="icon-rounded  mb-3 mx-auto  text-secondary">
                    <svg class="svg-icon w-2rem h-2rem align-middle">
                    <use xlink:href="#checkmark-1"> </use>
                    </svg>
                </div>-->
                <div class="hero-content pb-5 text-center">
                    <h1 class="hero-heading">Consulta Registrada    </h1>
                </div>
                <p class="text-muted mb-5">Gracias, la consulta ha quedado registrada.</p>
                <p><?php 
                $carrito = common\models\Carrito::findOne($id_carrito);
                ?>
<!--                    <a class="btn btn-outline-dark" href="https://api.whatsapp.com/send?phone=541135386219&text=<?= rawurlencode($carrito->getConsultaWhatsApp()) ?>&source=&data=#" >Pedido por WhatsApp 
                        <i style="font-size: 1.8em" class="fab fa-whatsapp"></i>
                    </a>-->
                </p>
                <a href="<?= \yii\helpers\Url::to(['update-consulta', 'id_carrito' => $id_carrito]) ?>" class="btn btn-outline-dark">Modificá tu consulta</a></p>
                <p> <a href="<?= \yii\helpers\Url::to(['hogar']) ?>" class="btn btn-outline-dark">Finalizar</a></p>
            </div>
        </section>

