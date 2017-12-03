
<?php 
use kartik\widgets\Growl;
use backend\models\Comment;
use backend\models\Food;
use backend\models\Rating;
//use backend\models\Orders;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\DateTimePicker;

$sumRate = Rating::find()->where(['restaurant_id'=>$Restaurant->id])->count(); 
$sumComment = Comment::find()->where(['restaurant_id'=>$Restaurant->id])->count();
$Food = Food::find()->where(['restaurant_id'=>$Restaurant->id])->all();
$listComment = Comment::find()->where(['restaurant_id'=>$Restaurant->id])->orderBy('created_at desc')->limit(10)->all();
$RateOne = Rating::find()->where(['restaurant_id'=>$Restaurant->id,'value'=>1])->count();
$RateTwo = Rating::find()->where(['restaurant_id'=>$Restaurant->id,'value'=>2])->count();
$RateThree = Rating::find()->where(['restaurant_id'=>$Restaurant->id,'value'=>3])->count();
$RateFour = Rating::find()->where(['restaurant_id'=>$Restaurant->id,'value'=>4])->count();
$RateFive = Rating::find()->where(['restaurant_id'=>$Restaurant->id,'value'=>5])->count();
?>

<div id='popup' style="display:false">
<?php 
echo Growl::widget([
    'type' => Growl::TYPE_SUCCESS,
    'title' => 'Xin chào, đây là '.$Restaurant->name,
    'icon' => 'glyphicon glyphicon-ok-sign',
    'body' => 'Nếu bạn thấy hay thì cho đánh giá 5* nhé !<br>Để lại bình luận để chúng tôi phục vụ tốt hơn',
    'showSeparator' => true,
    'delay' => 0,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ]
    ]
]);
?>

</div>


<link rel="stylesheet" type="text/css" href="view.css">
<h2 class="my-4 text-success" style="margin-left: 15px; color: green"><i class="glyphicon glyphicon-home"></i> <?=$Restaurant->name?></h2>
<hr>

<div class="container">
	<div id="main_area">
		<!-- Slider -->
		<div class="row">
			<div class="col-xs-12" id="slider">
				<!-- Top part of the slider -->
				<div class="row">
					<div class="col-sm-8" id="carousel-bounding-box">
						<div class="carousel slide" id="myCarousel">
							<!-- Carousel items -->
							<div class="carousel-inner">
								<div class="active item" data-slide-number="0">
									<img style="width:770px;height:350px;" src="/test/backend/web/<?=$Restaurant->image?>"></div>
									<span></span>

									<div class="item" data-slide-number="1">
										<img src="http://placehold.it/770x300&text=two"></div>

										<div class="item" data-slide-number="2">
											<img src="http://placehold.it/770x300&text=three"></div>

											<div class="item" data-slide-number="3">
												<img src="http://placehold.it/770x300&text=four"></div>

												<div class="item" data-slide-number="4">
													<img src="http://placehold.it/770x300&text=five"></div>

													<div class="item" data-slide-number="5">
														<img src="http://placehold.it/770x300&text=six"></div>
													</div><!-- Carousel nav -->
													<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
														<span class="glyphicon glyphicon-chevron-left"></span>                                       
													</a>
													<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
														<span class="glyphicon glyphicon-chevron-right"></span>                                       
													</a>                                
												</div>
											</div>

											<div class="col-sm-4" style="margin-top: : -20px">
												<h3 class="alert-order" style="color: red; font-weight: bold">

												<?= Yii::$app->session->getFlash('primary');?>
									</h3>
												
					<?php $form = ActiveForm::begin() ?> 

    <?= $form->field($Orders, 'restaurant_id')->hiddenInput(['value'=>$Restaurant->id])->label(false) ?>
<div class="form-group">
	

    <?= $form->field($Orders, 'name')->textInput(['maxlength' => true]) ?>
</div>
<div class="form-group">
    <?= $form->field($Orders, 'phone')->textInput(['maxlength' => true]) ?>
</div>
<div class="form-group">
    <?= $form->field($Orders, 'number_people')->textInput(['type' => 'number']) ?>
</div>
<div class="form-group">
   <?php echo $form->field($Orders, 'datetime')->widget(DateTimePicker::classname(), [
	'options' => ['placeholder' => 'Chọn thời gian ...'],
	'pluginOptions' => [
		'autoclose' => true
	]
]) ?>
</div>

<div class="form-group">
    <?= $form->field($Orders, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
</div>
   

    <div class="form-group">
        <?= Html::submitButton($Orders->isNewRecord ? 'ĐẶT BÀN NGAY' : 'Update', ['class' => $Orders->isNewRecord ? 'btn btn-primary btn-block' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>




												
												<!-- <h5><i class="glyphicon glyphicon-map-marker"></i> <?=$Restaurant->address?></h5>
												<h4><i class="glyphicon glyphicon-earphone"></i> <?=$Restaurant->phone?></h4>
												<h4><i class="glyphicon glyphicon-user"></i> <?=$Restaurant->user->username?></h4>
												<h4><i class="glyphicon glyphicon-home"></i> <?=$Restaurant->district->name?></h4>
												<h4><i class="glyphicon glyphicon-comment"></i> <?=$sumComment.' phản hồi'?></h4>
												<h4><i class="glyphicon glyphicon-star"></i> <?=$sumRate.' đánh giá'?></h4> -->
												
												





											</div>


										</div>
									</div>
								</div>

								<div class=" row col-md-8">
									<br>
									<h4 style="margin-left: 15px; font-weight: bold; color: blue" class="my-4">Thực đơn nhà hàng</h4>
									<hr>
									<?php if ($Food) : ?>
										<ul class="hide-bullets">
											<?php foreach($Food as $item): ?>
												<li class="col-sm-3">
													<a class="thumbnail" id="carousel-selector-0">
														<img style="width: 170px; height: 100px" src="/test/backend/web/<?=$item->image?>"></a>
														<p><?=$item->name?></p>
														<p><?php $s= number_format($item->price); echo 'Giá : '.$s.' VNĐ'; ?></p>

													</li>
												<?php endforeach; ?>


											</ul>   
										<?php else: ?>   
											<h3 class="text-danger" style="margin-left: 15px">Chưa có món nào</h3>
										<?php endif; ?>           
									</div>
									<div class="row col-md-4">


									</div>
								</div>



	<div class=" row col-md-4" style="margin-left: 30px" >
									<br>
									<h4 style=" font-weight: bold; color: blue">THÔNG TIN NHÀ HÀNG</h4>
									 <h5><i class="glyphicon glyphicon-map-marker"></i> <?=$Restaurant->address?></h5>
												<h4><i class="glyphicon glyphicon-earphone"></i> <?=$Restaurant->phone?></h4>
												<h4><i class="glyphicon glyphicon-user"></i> <?=$Restaurant->user->username?></h4>
												<h4><i class="glyphicon glyphicon-home"></i> <?=$Restaurant->district->name?></h4>
												<h4><i class="glyphicon glyphicon-comment"></i> <?=$sumComment.' phản hồi'?></h4>
												<h4><i class="glyphicon glyphicon-star"></i> <?=$sumRate.' đánh giá'?></h4> 
									
								</div>



							</div>



							<hr>




							<div class="container">

								<div class="row">
									<div class="col-sm-3">
										<div class="rating-block">
											<h4>Đánh giá của khách hàng</h4>
											<h2 class="bold padding-bottom-7"><?=$Restaurant->avg_rate?><small>/ 5</small></h2>
											
											<?php $form = ActiveForm::begin(); ?>



											<?php 
											echo $form->field($Rating, 'value')->widget(\yii2mod\rating\StarRating::class, [
												'options' => [

												],
												'clientOptions' => [


												],
											])->label('<b>Vote for restaurant !</b>');

											?>

											<?= $form->field($Rating, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>

											<?= $form->field($Rating, 'restaurant_id')->hiddenInput(['value'=>$Restaurant->id])->label(false) ?>


											<div class="form-group">
												<?= Html::submitButton($Rating->isNewRecord ? 'Đánh giá' : 'Update', ['class' => $Rating->isNewRecord ? 'btn btn-primary' : 'btn btn-primary',]) ?>
											</div>


											<?php ActiveForm::end(); ?>
											
											
											<h6 class="alert-rate" style="color: red; font-weight: bold">

												<?= Yii::$app->session->getFlash('danger');?>
										<?= Yii::$app->session->getFlash('success');?>

									</h6>
										</div>
									</div>
									<div class="col-sm-3">
										<h4>Ý kiến của khách hàng</h4>
										<div class="pull-left">
											<div class="pull-left" style="width:35px; line-height:1;">
												<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
											</div>
											<div class="pull-left" style="width:180px;">
												<div class="progress" style="height:9px; margin:8px 0;">
													<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
														<span class="sr-only">80% Complete (danger)</span>
													</div>
												</div>
											</div>
											<div class="pull-right" style="margin-left:10px;"><?=$RateFive?></div>
										</div>
										<div class="pull-left">
											<div class="pull-left" style="width:35px; line-height:1;">
												<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
											</div>
											<div class="pull-left" style="width:180px;">
												<div class="progress" style="height:9px; margin:8px 0;">
													<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
														<span class="sr-only">80% Complete (danger)</span>
													</div>
												</div>
											</div>
											<div class="pull-right" style="margin-left:10px;"><?=$RateFour?></div>
										</div>
										<div class="pull-left">
											<div class="pull-left" style="width:35px; line-height:1;">
												<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
											</div>
											<div class="pull-left" style="width:180px;">
												<div class="progress" style="height:9px; margin:8px 0;">
													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
														<span class="sr-only">80% Complete (danger)</span>
													</div>
												</div>
											</div>
											<div class="pull-right" style="margin-left:10px;"><?=$RateThree?></div>
										</div>
										<div class="pull-left">
											<div class="pull-left" style="width:35px; line-height:1;">
												<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
											</div>
											<div class="pull-left" style="width:180px;">
												<div class="progress" style="height:9px; margin:8px 0;">
													<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
														<span class="sr-only">80% Complete (danger)</span>
													</div>
												</div>
											</div>
											<div class="pull-right" style="margin-left:10px;"><?=$RateTwo?></div>
										</div>
										<div class="pull-left">
											<div class="pull-left" style="width:35px; line-height:1;">
												<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
											</div>
											<div class="pull-left" style="width:180px;">
												<div class="progress" style="height:9px; margin:8px 0;">
													<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
														<span class="sr-only">80% Complete (danger)</span>
													</div>
												</div>
											</div>
											<div class="pull-right" style="margin-left:10px;"><?=$RateOne?></div>
										</div>
									</div>			
								</div>	


								<div class="col-sm-7">
									<h4 class="alert-comment" style="color: red; font-weight: bold">

										<?= Yii::$app->session->getFlash('warning');?>
									</h4>
									<?php Pjax::begin(); ?>
									<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true,
                  'id'=> 'dynamic-form111',
                  // 'validationUrl' => 'validation-rul'
                   ]]); ?> 

									<?= $form->field($Comment, 'body')->textarea(['rows' => 6])->label('Gửi bình luận') ?>

									<?= $form->field($Comment, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>

									<?= $form->field($Comment, 'restaurant_id')->hiddenInput(['value'=>$Restaurant->id])->label(false) ?>



									<div class="form-group">
										<?= Html::submitButton($Comment->isNewRecord ? 'Gửi bình luận' : 'Update', ['class' => $Comment->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
									</div>

									<?php ActiveForm::end(); ?> 
									<?php Pjax::end(); ?>

								</div>		

								<div class="row">
									<div class="col-sm-7">
										<hr/>

										<div class="review-block">
											<?php foreach($listComment as $key): ?>
												<div class="row">

													<div class="col-sm-3">
														<img src="images.png" class="img-rounded" style="width:60px; heigth:60px">
														<div class="review-block-name"><a href="#"><?=$key->user->username?></a></div>
														<div class="review-block-date"><?php echo Yii::$app->formatter->asDate($key->created_at, 'dd-MM-yyyy') ?></div>

													</div>
													<div class="col-sm-9">
														<div class="review-block-rate">
															<?php 
															$x= rand(3,5)/1.1;
															echo \yii2mod\rating\StarRating::widget([
																'name' => 'input_name',
																'value' => $x,
																'clientOptions' => [

																],
															]);
															?>
														</div>
														<div class="review-block-title"><?=$key->user->username.' đã ghé thăm trang này '.rand(1,15).' lần.'   ?></div>
														<div class="review-block-description"><?=$key->body?></div>
													</div>
												</div>
												<hr/>
											<?php endforeach; ?>

										</div>
									</div>
								</div>

							</div> <!-- /container -->


							<script>


								
        $(window).load(function(){
        	setTimeout(function(){
    					$('.alert-comment').fadeOut();}, 5000);
    					setTimeout(function(){
    					$('.alert-order').fadeOut();}, 5000);

    					setTimeout(function(){
    					$('.alert-rate').fadeOut();}, 5000);

         
      });
        
   

				

						
							</script>





  
    	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
</body>
</html>
