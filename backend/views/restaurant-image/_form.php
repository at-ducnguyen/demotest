<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Restaurant;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\RestaurantImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-image-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?> -->


<?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]);?>
    

    <?= $form->field($model, 'restaurant_id')->dropDownList(
        ArrayHelper::map(Restaurant::find()->all(),'id','name'),

        ['prompt'=>'Chọn nhà hàng']
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

