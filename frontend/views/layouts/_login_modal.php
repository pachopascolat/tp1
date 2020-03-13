<div id="login-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $user = Yii::createObject(dektrium\user\models\LoginForm::className());
            yii\widgets\Pjax::begin();
//            echo  Html::beginForm(['/user/login'], 'post');
            $form = \yii\widgets\ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'id' => 'login-form',
                        'action' => ['/user/login']
            ]);
            ?>
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">




                                <?=
                                $form->field($user, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'autocomplete' => "username"]]
                                );
                                ?>



                                <?=
                                        $form->field(
                                                $user, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'autocomplete' => "current-password"]])
                                        ->passwordInput()
                                        ->label()
                                ?>


                                <?= $form->field($user, 'rememberMe')->checkbox(['tabindex' => '3']) ?>



                            </div>
                        </div>
                    </div>
                    <!--</div>-->


                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <?php
                yii\widgets\ActiveForm::end();
                yii\widgets\Pjax::end();
                ?>

            </div>
        </div>
    </div>
</div>