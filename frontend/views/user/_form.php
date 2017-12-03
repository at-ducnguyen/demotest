<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => true])->label('Tên đăng nhập') ?>

    <?= $form->field($model, 'auth_key')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'password_hash')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'password_reset_token')->hiddenInput(['maxlength' => true])->label(false) ?>
     <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
     <?= $form->field($model, 'role')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Địa chỉ') ?>

    <?= $form->field($model, 'hobby')->textInput(['maxlength' => true])->label('Sở thích') ?>

   

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Cập Nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
