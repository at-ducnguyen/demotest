<?php
$this->title = 'Đồ án Tốt Nghiệp';
?>
<?php require('link.php'); ?> <!--  Khai báo CSS. JavaScript -->
<?php require('slider.php'); ?><!--  Show Slider -->

<?php 
// khai báo model và thư viện cần thiết
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
<!--HỆ THỐNG GỢI Ý-->

<?php if (isset($_POST['submit'])){
$Res_Hight = Restaurant::find()->where(['city_id'=>$_POST['city']])->orderBy('avg_rate DESC')->all();
$Res_TopComment = Restaurant::find()->where(['city_id'=>$_POST['city']])->orderBy('num_comment DESC')->all();

} ?>


<?php if ($postRes): ?><hr>
  <!-- Form tìm kiếm -->
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

<!-- Kết thúc form tìm kiếm -->


<!-- Code xử lý tìm kiếm -->
<?php 

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
<h3 class="my-4 text-success" style="text-align:center;">Kết quả tìm được</h3>
<h5 class="my-4 text-info" style="text-align:center;"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></h5>

<?php if (!$result) : ?>
  <h2 class="text-danger center-block">Không tìm được nhà hàng nào!</h2>
  <?php else: ?>

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

<?php endif; ?>



<?php else: ?>
<!-- Kết thúc hiển thị kết quả tìm kiếm -->

<hr>
<div class="container-fluid text-center" >
<?php Pjax::begin(); ?>
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
<?php Pjax::end(); ?>
  </div>
<!-- Kết thúc code xử lý tìm kiếm -->
<!-- Kết thúc code tìm kiếm -->

<div id="display" style="">
<!--NHÀ HÀNG ĐƯỢC ĐÁNH GIÁ CAO-->
<h3 class="my-4 text-success" style="text-align:center;">Nhà hàng được đánh giá cao</h3>
<h5 class="my-4 text-info" style="text-align:center;"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></h5>



<ul class="row" id="myList">
  <?php foreach ($Res_Hight as $key): ?>
    <?php $str_name = strlen($key->name);
     $str_addr = strlen($key->address);

if ($str_name >25) { 
  $res_name = mb_substr($key->name, 0,15,'UTF-8').' ...';
}else {$res_name = $key->name;}

if ($str_addr >50) { 
  $res_addr = mb_substr($key->address, 0,40,'UTF-8').' ...';
}else {$res_addr = $key->address;}
     ?>
  <div class="col-md-4">
    <li class="thumbnail">
     <?php $sumComment = Comment::find()->where(['restaurant_id'=>$key->id])->count(); ?>
     <?php $sumRate = Rating::find()->where(['restaurant_id'=>$key->id])->count(); ?>
      <a href="index.php?r=site/view&id=<?=$key->id?>" title="" data-toggle='modal' data-target='#login-modal'><img style="width: 400px; height: 200px" src="/test/backend/web/<?=$key->image?>" alt="..."> </a>
      <div class="caption">
        <h3><?php  $star = $key->avg_rate; echo '<span class="text-success" style="font-weight:bold">'.$res_name.'</span>' ?></h3>
        <p style="font-style: italic;"><i class="glyphicon glyphicon-map-marker"></i> <?=$res_addr?></p>
        <p><i class="glyphicon glyphicon-earphone"></i> <?=$key->phone?></p>
        <p style="color: red"><i class="glyphicon glyphicon-comment"></i> <?=$sumComment?> bình luận   <i class="glyphicon glyphicon-star"></i> <?=$sumRate?> đánh giá     </p>
       <?php echo '<b style="color:blue">Đánh giá </b>'.\yii2mod\rating\StarRating::widget([
    'name' => 'input_name',
    'value' => $star,
    'clientOptions' => [
       'readOnly'=>true
    ],
 ],['class'=>'form-inline']); ?>  
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
<!--END NHÀ HÀNG ĐƯỢC ĐÁNH GIÁ CAO-->
<hr>





<!--NHÀ HÀNG ĐƯỢC NGƯỜI DÙNG QUAN TÂM NHIỀU NHẤT-->
<h3 class="my-4 text-success" style="text-align:center;">Nhà hàng được quan tâm nhiều nhất</h3>
<h5 class="my-4 text-info" style="text-align:center;"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></h5>



<ul class="row" id="xxx">
  <?php foreach ($Res_Hight as $key): ?>
    <?php $str_name = strlen($key->name);
     $str_addr = strlen($key->address);

if ($str_name >25) { 
  $res_name = mb_substr($key->name, 0,15,'UTF-8').' ...';
}else {$res_name = $key->name;}

if ($str_addr >50) { 
  $res_addr = mb_substr($key->address, 0,40,'UTF-8').' ...';
}else {$res_addr = $key->address;}
     ?>
  <div class="col-md-4">
    <li class="thumbnail">
     <?php $sumComment = Comment::find()->where(['restaurant_id'=>$key->id])->count(); ?>
     <?php $sumRate = Rating::find()->where(['restaurant_id'=>$key->id])->count(); ?>
      <a href="index.php?r=site/view&id=<?=$key->id?>" title="" data-toggle='modal' data-target='#login-modal'><img style="width: 400px; height: 200px" src="/test/backend/web/<?=$key->image?>" alt="..."> </a>
      <div class="caption">
        <h3><?php  $star = $key->avg_rate; echo '<span class="text-success" style="font-weight:bold">'.$res_name; ?></h3>
        <p style="font-style: italic;"><i class="glyphicon glyphicon-map-marker"></i> <?=$res_addr?></p>
        <p><i class="glyphicon glyphicon-earphone"></i> <?=$key->phone?></p>
        <p style="color: red"><i class="glyphicon glyphicon-comment"></i> <?=$sumComment?> bình luận   <i class="glyphicon glyphicon-star"></i> <?=$sumRate?> đánh giá     </p>
       <?php echo '<b style="color:blue">Đánh giá </b>'.\yii2mod\rating\StarRating::widget([
    'name' => 'input_name',
    'value' => $star,
    'clientOptions' => [
       'readOnly'=>true
    ],
 ],['class'=>'form-inline']); ?>  
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
<div class="col-md-offset-5">
<button id="loadMorex" class="btn btn-success">Xem Thêm</button>
<button id="showLessx" class="btn btn-danger">Quay Lại</button>
</div>

</div>

<!--END NHÀ HÀNG NỔI BẬT-->

<hr>

    <?=ProductWidgets::Widget();?>

  <?php endif; ?>


  <div class="modal fade" id="myModal_share" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chia sẻ địa chỉ</h4>
        </div>
        <div class="modal-body">
          <p>Vui lòng chia sẽ địa chỉ hiện tại của bạn để hệ thống đưa ra gợi ý tốt nhất cho bạn!</p>
<?php $Cityx = backend\models\City::find()->all(); ?>
<form action="" method="post">
          <select class="form-control" id="share_cities" name="city">
            <?php foreach($Cityx as $item): ?>
            <option value="<?=$item->id?>"><?= $item->name ?></option>
            <?php endforeach; ?>
          </select>
                    
          </div>
          <div class="modal-footer">
            
            <input type="submit" name="submit" class="btn btn-primary" value = "Chấp nhận" id="address_share">
            <input type="button" name="btn" class="btn btn-danger" value = "Bỏ qua" id="close_share">
          </div>
        </form>
      </div>

    </div>
  </div>


  
  <script>
    
<?php
      // 86400*30
      if (!isset($_COOKIE['modal'])){
        setcookie("modal", "true", time()+86400, "/");
    ?>
       $(window).load(function(){
         setTimeout(function(){
             $('#myModal_share').modal('show');
         }, 7000);
      });
        
    <?php } ?>

    $(document).ready(function(){
      $("#close_share").click(function(){
        $("#myModal_share").modal('hide');
      });
      

      
    });



  </script>
  

 <div class="sugget" >
<span style="color: white;vertical-align: super;" data-toggle="modal" data-target="#myModal_share" id="flag">Chia sẻ vị trí</span>
</div> 
<style type="text/css" media="screen">
.sugget{
z-index:999; text-align:center;
background:#000000; position:fixed; 
top:45%; left:10px; padding:20px 10px; 
border:1px solid #333; border-radius:10px;
  } 
@media screen and (max-width:768px){
 .sugget{
display:none;
}
  
</style>
