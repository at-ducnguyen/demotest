<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
 
Modal::begin([
    'header'=>'<h4>Đăng Nhập</h4>',
    'id'=>'login-modal',
]);
?>
 
   
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Vui lòng đăng nhập vào hệ thống</h3>
    </div>
    <div class="panel-body">
        
 
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-login']
]);
echo $form->field($model, 'username')->textInput()->label('Tên đăng nhập');
echo $form->field($model, 'password')->passwordInput()->label('Mật khẩu');
echo $form->field($model, 'rememberMe')->checkbox()->label('Ghi nhớ');
?>
 

<div class="form-group">
    <div class="text-right">
 
        <?php
        echo Html::submitButton('Đăng Nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ;
        echo '&nbsp;&nbsp;';
        echo Html::button('Quay Lại', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']);
        
        
        ?>
 
    </div>
</div>
    </div>
</div>
 
<?php 
ActiveForm::end();
Modal::end();
?>