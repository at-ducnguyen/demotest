<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



$this->title = 'Đăng Ký';
$this->params['breadcrumbs'][] = $this->title;
?>

    
    

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Đăng ký</h3>
    </div>
    <div class="panel-body">
        <p>Vui lòng hoàn thành các thông tin bên dưới:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Tên đăng nhập') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Mật khẩu') ?>
                
                <?= $form->field($model, 'address')->textInput()->label('Địa chỉ') ?>
                
                
        

                <div class="form-group">
                    <?= Html::submitButton('Đăng Ký', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>