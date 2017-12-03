<?php 
use backend\models\Food;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Restaurant;


 ?>

<h3 class="text-danger">Nhà hàng <?=$model->name?></h3>
<hr>

 <div class="panel panel-success">
 	<div class="panel-heading">
 		<h3 class="panel-title">Thêm mới món ăn</h3>
 	</div>
 	<div class="panel-body">
 		<?php $form = ActiveForm::begin((['options' => ['enctype' => 'multipart/form-data']])); ?>

    <?= $form->field($Food, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($Food, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($Food, 'file')->fileInput(['maxlength' => true]) ?>
	<?= $form->field($Food, 'restaurant_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
   

   

    <div class="form-group">
        <?= Html::submitButton($Food->isNewRecord ? 'Thêm Mới' : 'Update', ['class' => $Food->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

 	</div>
 </div>


 






