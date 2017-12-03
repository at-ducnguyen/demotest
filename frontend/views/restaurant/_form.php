<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\City;
use backend\models\District;
use backend\models\User;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="panel panel-default col-md-7">
    <div class="panel-heading">
        <h3 class="panel-title" style="color: blue; font-weight: bold"><i class="glyphicon glyphicon-plus"></i> Thêm mới nhà hàng</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin((['options' => ['enctype' => 'multipart/form-data']])); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]);?>
      <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>
      <?= $form->field($model, 'status')->hiddenInput(['value'=>'Đang hoạt động'])->label(false) ?>




<?= $form->field($model, 'city_id')->dropDownList(
        ArrayHelper::map(City::find()->all(),'id','name'),

        ['prompt'=>'Chọn tỉnh thành phố',
         'onchange' => '
            $.post( "index.php?r=district/lists&id='.'"+$(this).val(), function( data ){
            $( "select#restaurant-district_id" ).html( data )
            });'
])->label('Địa điểm') ?>


<?= $form->field($model, 'district_id')->dropDownList(
        ArrayHelper::map(District::find()->all(),'id','name'),

        ['prompt'=>'Chọn quận huyện',
         
    ])->label(false) ?>











    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>

    

