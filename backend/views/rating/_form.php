<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use backend\models\Restaurant;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Rating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput() ?>

 

<?php echo $form->field($model, 'user_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(User::find()->all(),'id','username'),
    'language' => 'de',
    'options' => ['placeholder' => 'Chọn người quản lý ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
],['style'=>'width:200px']); ?>

<?php echo $form->field($model, 'restaurant_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Restaurant::find()->all(),'id','name'),
    'language' => 'de',
    'options' => ['placeholder' => 'Chọn nhà hàng ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
],['style'=>'width:200px']); ?>



    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
