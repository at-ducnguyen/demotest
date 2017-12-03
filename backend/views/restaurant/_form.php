<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\City;
use backend\models\District;
use backend\models\User;
use kartik\widgets\FileInput;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin((['options' => ['enctype' => 'multipart/form-data']])); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]);?>

    <!-- <?= $form->field($model, 'no_address')->textInput() ?>

    <?= $form->field($model, 'avg_rate')->textInput() ?>

    <?= $form->field($model, 'no_rate')->textInput() ?>

    <?= $form->field($model, 'no_suggestion')->textInput() ?> -->

    <?= $form->field($model, 'status')->dropDownList(
        [
            1 => 'Đang hoạt động',
            2 => 'Ngừng hoạt động'
        ],

        ['prompt'=>'Chọn trạng thái']
        ) ?>

   


<?php echo $form->field($model, 'user_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(User::find()->all(),'id','username'),
    'language' => 'de',
    'options' => ['placeholder' => 'Nhập người quản lý ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
],['style'=>'width:200px']); ?>



<?= $form->field($model, 'city_id')->dropDownList(
        ArrayHelper::map(City::find()->all(),'id','name'),

        ['prompt'=>'Chọn Tỉnh Thành Phố',
         'onchange' => '
            $.post( "index.php?r=district/lists&id='.'"+$(this).val(), function( data ){
            $( "select#restaurant-district_id" ).html( data )
            });'
    


    ]) ?>

     <?= $form->field($model, 'district_id')->dropDownList(
        ArrayHelper::map(District::find()->all(),'id','name'),

        ['prompt'=>'Chọn quận huyện',
         
    ]) ?>






    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
