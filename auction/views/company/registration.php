<?php


use yii\helpers\Html;
use auction\components\Auction;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->title = Auction::$app->name.' :: Company Registration';

?>
<div class="row">
    <?php if(Auction::$app->session->hasFlash('success')):?>

        <?php Alert::begin([
            'options' => [
                'class' => 'alert-success',
            ],
        ]);

        echo 'Company Registration Success';

        Alert::end();?>

    <?php endif;?>
    <div class="col-md-6 "><!--Add col-md-offset-3 to make it in center-->
        <div class="login-panel panel panel-info" style="margin-top: 20px">
            <div class="panel-heading">
                <h3 class="panel-title">Company Registration</h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'successCssClass' => false,
                    'fieldClass' => 'auction\widgets\ActiveField',
                    'options'=> ['role' => 'form' ,'enctype' => 'multipart/form-data']]); ?>
                <fieldset>

                    <?= $form->field($model, 'name')->textInput() ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'domain')->textInput() ?>

                    <?= $form->field($model, 'mobile')->textInput() ?>

                    <?= $form->field($model, 'contact')->textInput() ?>

                    <?= $form->field($model, 'image')->fileInput(['class' => false]) ?>

                    <?= $form->field($model, 'email')->textInput() ?>

                    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                    <?= Html::submitButton('Register As Company',['class' => 'btn btn-lg btn-info btn-block'])?>

                </fieldset>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>