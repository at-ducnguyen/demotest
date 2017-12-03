<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
$model = User::find()->where(['id'=>Yii::$app->user->identity->id])->one();

/* @var $this yii\web\View */
/* @var $model backend\models\User */


$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Thông tin người dùng</h3>
            <hr>
            <div class="well well-sm">
                <div class="row">
                    <div class="col-md-4">
                        <img style="width: 380px; height: 200px" src="<?=$model->avatar?>" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-md-8">
                        <h4>
                            Tên đăng nhập: <?=$model->username?></h4>
                        <small><cite title="San Francisco, USA"><?=$model->address?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?=$model->email?>
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">http://facebook.com</a>
                            <br />
                            <i class="glyphicon glyphicon-comment"></i><?=$model->hobby?>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1994</p>
                        <!-- Split button -->
                        <div class="btn-group">
                           <a href="index.php?r=user/update" title=""><button type="button" class="btn btn-primary">
                                Sửa Profile</button> </a>
                           <a href="index.php?r=user/avatar" title=""><button type="button" class="btn btn-primary">
                               
                                Sửa Avatar</button> </a>


                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    </div>
</div>
<style type="text/css" media="screen">
body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
    
</style>