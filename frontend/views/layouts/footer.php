<!-- Footer -->
<footer class="page-footer font-small indigo">

    <!-- Footer anexo -->
    <div class="container">
        <div  class="d-flex flex-row justify-content-center ">
            <div class="footer-anexo pr-4 pl-4 d-flex align-items-center">
                <span>Mas informacion  <i class="far fa-chevron-down"></i></span>
            </div>
        </div>
    </div>
    <!-- Footer Links -->
    <div class="site-footer">
        <div class="container">
            <!-- row -->
            <div class="d-flex w-100 flex-row justify-content-between align-items-start ">
                <!-- column 1 -->
                <div class="">
                    <!-- Links -->
                    <a href="#!" class="titulos-f-1">Publicaciones</a>
                    <div class="links">
                        <ul class="list-unstyled  ">
                            <li>
                                <a class="links-footer" href="#!">Mas visitadas</a>
                            </li>
                            <li>
                                <a href="#!" class="links-footer">Novedades</a>
                            </li>
                        </ul>
                    </div>  
                </div>
                <!-- column 2 -->
                <div class="">
                    <!-- Links -->
                    <a  href="#!" class="titulos-f-1">Sucursales</a>
                    <div class="links">
                        <ul class="list-unstyled">
                            <li>
                                <a class="links-footer" href="#!">Lavalle 2571 - Once</a>
                            </li>
                            <li>
                                <a class="links-footer" href="#!">Azcuenaga 580 - Once</a>
                            </li>
                            <li>
                                <a class="links-footer" href="#!">Olavarria 2348 - Celina</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--column 3  -->
                <div class="">

                    <!-- Links -->
                    <a  href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>" class="titulos-f-1">Moda</a>
                    <div class="links">

                        <ul class="list-unstyled">
                            <?php
                            $categoriasModa = \common\models\Categoria::find()->where(['moda' => true])->all();
                            foreach ($categoriasModa as $catMod):
                                ?>
                                <li>
                                    <a class="links-footer" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => $catMod->id_categoria]) ?>"><?= $catMod->nombre_categoria ?></a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>

                <!--column 4 -->
                <div class="">

                    <!-- Links -->
                    <a  href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>" class="titulos-f-1">Hogar</a>
                    <div class="links">
                        <ul class="list-unstyled">
                            <?php
                            $categoriasHogar = \common\models\Categoria::find()->where(['hogar' => true])->all();
                            foreach ($categoriasHogar as $catHog):
                                ?>

                                <li>
                                    <a class="links-footer" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => $catHog->id_categoria]) ?>"><?= $catHog->nombre_categoria ?></a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>

                </div>
                <!-- column 5 -->
                <div class="">

                    <!-- Links -->

                    <ul class="list-unstyled" >
                        <li>
                            <a  href="#!" class="titulos-f-2">Mis consultas</a>
                        </li>
                        <div class="links">
                            <li>
                                <a  href="#!" class="titulos-f-2">Ayuda</a>
                            </li>
                        </div>
                    </ul>
                </div>

                <!--column 6  -->
                <div class="">

                    <!-- Links -->
                    <a href="#!" class="titulos-f-2">Redes sociales</a>
                    <div class="links">
                        <ul class="list-unstyled">
                            <li>
                                <a class="links-footer" href="#!">Facebook</a>
                            </li>
                            <li>
                                <a class="links-footer" href="#!">Instagram</a>
                            </li>
                            <li>
                                <a class="links-footer" href="#!">Youtube</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--column 7  -->
                <div class="">

                    <!-- Links -->
                    <a href="#!" class="titulos-f-2">Mi cuenta</a>

                    <div class="links">
                        <ul class="list-unstyled">
                            <li>
                                <a class="links-footer" href="#!">Historial de consultas realizadas</a>
                            </li>
                            <li>
                                <a class="links-footer" href="#!">Favoritos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    </div>

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="footer-copyright d-flex justify-content-between align-items-center">
                <p> COPYRIGHT © 1999-<?= date("Y") ?> TEXSIM</p>
                <p>  Venta mayorista de rollos y de productos confeccionados con telas y diseños TEXSIM</p>
            </div>
        </div>
    </div>
    <!-- Copyright -->
</div>
</footer>
<!-- Footer -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
