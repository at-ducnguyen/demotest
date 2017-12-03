<?php

use backend\models\Restaurant;
use backend\models\City;
use backend\models\Comment;
use backend\models\Food;
use backend\models\Rating;
use backend\models\District;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use frontend\widgets\SearchWidget;
$model = new Restaurant();
?>
<!--HỆ THỐNG GỢI Ý-->


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


<?php 
$postRes = Yii::$app->request->post('Restaurant');
$result = Restaurant::find()->all();

if ($postRes
['name'] && !$postRes['city_id'] && !$postRes['district_id']) {
    $result = Restaurant::find()->where(['name'=>$postRes['name']])->all();
}
if (!$postRes['name'] && $postRes['city_id'] && $postRes['district_id']) {
    $result = Restaurant::find()->where(['city_id'=>$postRes['city_id'],'district_id'=>$postRes['district_id']])->all();
}
if (!$postRes['name'] && !$postRes['city_id'] && $postRes['district_id']) {
   $result = Restaurant::find()->where(['district_id'=>$postRes['district_id']])->all();
}


 ?>

<!-- Hiển thị kết quả tìm kiếm -->
<div style='display: none'>
<h3 class="my-4 text-success" style="text-align:center;">Kết quả tìm được</h3>
<h5 class="my-4 text-info" style="text-align:center;"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></h5>

<?php if (!$result) {  ?>
  <h2 class="text-danger center-block">Không tìm được nhà hàng nào!</h2>
  <?php }else{ ?>

  <hr>

  
<ul class="row" id="myList">
  <?php foreach ($result as $key): ?>
  <div class="col-md-4">
    <li class="thumbnail">
     <?php $sumComment = Comment::find()->where(['restaurant_id'=>$key->id])->count(); ?>
     <?php $sumRate = Rating::find()->where(['restaurant_id'=>$key->id])->count(); ?>
      <img style="width: 400px; height: 200px" src="/test/backend/web/<?=$key->image?>" alt="...">
      <div class="caption">
        <h3><?php  $star = $key->avg_rate; echo $key->name; ?></h3>
        <p><i class="glyphicon glyphicon-map-marker"></i> <?=$key->address?></p>
        <p><i class="glyphicon glyphicon-earphone"></i> <?=$key->phone?></p>
        <p><i class="glyphicon glyphicon-comment"></i> <?=$sumComment?> Comments    <i class="glyphicon glyphicon-star"></i> <?=$sumRate?> Ratings     </p>
       <?php echo 'Đánh giá '.\yii2mod\rating\StarRating::widget([
    'name' => 'input_name',
    'value' => $star,
    'clientOptions' => [
       
    ],
 ]); ?>  
        <?php if(Yii::$app->user->isGuest):?>
        <p><a href="index.php?r=site/view&id=<?=$key->id?>" class="btn btn-primary btn-block" data-toggle='modal' data-target='#login-modal' role="button">Xem chi tiết</a> </p>
      <?php else: ?>
        <p><a href="index.php?r=site/view&id=<?=$key->id?>" class="btn btn-primary btn-block" role="button">Xem chi tiết</a> </p>
      <?php endif; ?>

      </div>
    </li>
  </div>
<?php endforeach; ?>
</ul>
<div style="text-align:center;">
<button id="loadMore" class="btn btn-success">Xem Thêm</button>
<button id="showLess" class="btn btn-danger">Quay Lại</button>
</div>
</div>
<?php } ?>




