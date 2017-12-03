<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Đổi Avatar</h3>
    </div>
    <div class="panel-body">
        <div class="row">

    <div class="col-md-4">
        <p class="text-left"></p>
        <?php if(!$model->avatar) :?>
            <br>
            
            <h3 class="text-danger">Chưa có avatar</h3>
        <?php else: ?>
        <img src="<?=$model->avatar?>" alt="">
    <?php endif; ?>
        
    </div>
    <div class="col-md-8">
         <?php $form = ActiveForm::begin(); ?>

   
    <?php echo $form->field($model, 'file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],])->label('Avatar');?>

    

    
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        
    </div>
    
</div>
    </div>
</div>








   

