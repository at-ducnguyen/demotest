<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->context->layout = 'error';
$this->title = $name;
?>
<div class="site-error">

    <h2 class="text-center">Xin chào <span style="font-weight: bold;color: red"><?=Yii::$app->user->identity->username?></span></h2>

    <div class="alert alert-danger text-center">
        Đây là trang dành cho người quản trị. Bạn không có quyền truy cập trang này! 
        
    </div>
    <div class="text-center">
    	
    <a href="/test/frontend/web"><button class="btn btn-danger"><i class="glyphicon glyphicon-home"></i> Quay về trang chủ</button> </a> </div>
    <br>
    <div class="text-center">
    	<a href="index.php?r=site/logout"><button class="btn btn-primary"> Đăng nhập với tài khoản admin <i class="glyphicon glyphicon-log-in"></i></button></a>
     </div>
<br>
 <br>
 <br>
 <br>
 <br>
 <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
