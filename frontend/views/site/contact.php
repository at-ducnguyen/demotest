<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Liên hệ với chúng tôi';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="text-danger"><?= Html::encode($this->title) ?></h1>
    <?php echo Yii::$app->session->getFlash('success'); ?>
    <hr>
<div class="panel panel-success">
    <div class="panel-heading">
        <p class="panel-title">Vui lòng hoàn thành mẫu form bên dưới
    </p></h3>
    </div>
    <div class="panel-body">
       <div class="site-contact">
    

    
        

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                
                <div class="form-group">
                    <?= Html::submitButton('Gửi liên hệ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
    </div>
</div>