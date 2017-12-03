<?php 
use backend\models\Comment;
use backend\models\District;
use backend\models\City;
use backend\models\Food;
use backend\models\Rating;
use backend\models\Restaurant;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use frontend\widgets\ProductWidgets;
use frontend\widgets\SearchWidget;

 ?>



<div class="container-fluid text-center" >

    <?php $form = ActiveForm::begin([
    
    'options' => ['class' => 'form-inline'],
]) ?> 
<?php echo $form->field($model, 'name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Restaurant::find()->all(),'name','name'),
    'language' => 'de',
    'options' => ['placeholder' => 'Nhập tên nhà hàng ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
],['style'=>'width:200px'])->label(false); ?>




<?= $form->field($model, 'city_id')->dropDownList(
        ArrayHelper::map(City::find()->all(),'id','name'),

        ['prompt'=>'Chọn tỉnh thành phố',
         'onchange' => '
            $.post( "index.php?r=district/lists&id='.'"+$(this).val(), function( data ){
            $( "select#restaurant-district_id" ).html( data )
            });'
])->label(false) ?>


<?= $form->field($model, 'district_id')->dropDownList(
        ArrayHelper::map(District::find()->all(),'id','name'),

        ['prompt'=>'Chọn quận huyện',
         
    ])->label(false) ?>


<?= Html::submitButton('Tìm Kiếm', ['class' => 'btn btn-primary','style'=>'margin-bottom:10px']) ?>


    <?php ActiveForm::end(); ?>

  </div>
