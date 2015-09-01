<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use auction\components\helpers\DatabaseHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model auction\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-active-form">

    <?php Pjax::begin(['id' => 'brand-form','enablePushState' => false, 'timeout' => false])?>

    <?php $form = ActiveForm::begin([
        'id' => 'create-brand',
        //'action' => Url::to(['brand/create']),
        'options' => [
            'data-pjax' => 1,
        ],
        'enableClientValidation' => false

    ]); ?>

    <?= Html::hiddenInput('id', $model->id);?>

    <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => 'Template Name','autofocus' => 'autofocus']) ?>

    <?= $form->field($model, 'type')->dropDownList(DatabaseHelper::TemplateType())->label('Template Type') ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'is_active')->dropDownList(DatabaseHelper::Status())->label('Status') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>

</div>
