<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Carousel;
use frontend\widgets\LoginFormWidget;
use kartik\widgets\Growl;


AppAsset::register($this);
?>
<?php 
$countRes = backend\models\Restaurant::find()->where(['user_id'=>Yii::$app->user->id])->count();
            
$countOr = backend\models\Orders::find()->joinWith(['restaurant b'],true,'INNER JOIN')->where(['b.user_id'=>Yii::$app->user->id])->count();

 $countDXL = backend\models\Orders::find()
 ->where(['user_id'=>Yii::$app->user->identity->id])
 ->andWhere(['or',['status'=>'Chấp nhận'],['status'=>'Phản đối']])
 ->count();

 $countCXL = backend\models\Orders::find()
 ->where(['user_id'=>Yii::$app->user->identity->id,'status'=>'Chờ'])
 ->count();

                    ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
  <?php $this->beginBody() ?>
<?php if (Yii::$app->user->isGuest) { 

  echo LoginFormWidget::widget([]); } ?>

  <div class="wrap">
    <nav class="navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><span class=" glyphicon glyphicon-home"></span> Trang chủ</a>
        </div>

       
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
           


          </ul>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Tìm Kiếm</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?r=site/about">Giới Thiệu</a></li>

            <li><a href="index.php?r=site/contact">Liên Hệ</a></li>
            <?php if (Yii::$app->user->isGuest) : ?>
              <li><a href="index.php?r=site/signup">Đăng Ký</a></li>
              <li><a href="index.php?r=site/login" data-toggle='modal' data-target='#login-modal'>Đăng Nhập <span class="glyphicon glyphicon-log-in"></span></a></li>
            <?php else : ?>
<?php if (Yii::$app->user->identity->role!=1) : ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="glyphicon glyphicon-comment"></i> Thông báo <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  
                    <li><a href="index.php?r=orders/myorder">Chờ xử lý <b style="font-weight: bold; color: red">(<?=$countCXL?>)</b></a></li>
                  
                    <li><a href="index.php?r=orders/history">Lịch sử đặt bàn<b style="font-weight: bold; color: blue">(<?=$countDXL?>) </b></a></li>
                  
                  

              
                  

              </ul>
            </li>
<?php endif; ?>


              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo '<i class="glyphicon glyphicon-user"></i> '.Yii::$app->user->identity->username; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php if (Yii::$app->user->identity->role==1) : ?>
                    <li><a href="/test/backend/web">Quản lý Admin</a></li>
                  <?php elseif (Yii::$app->user->identity->role==3) : ?>
                    
                    <?php if ($countRes >0): ?>
                    <li><a href="index.php?r=restaurant">Quản lý nhà hàng <b style="font-weight: bold; color: red">(<?php echo $countRes; ?>) </b></a></li>
                  <?php else: ?>
                    <li><a href="index.php?r=restaurant">Quản lý nhà hàng</a></li>
                  <?php endif; ?>
                    <li><a href="index.php?r=orders">Quản lý đặt bàn <b style="font-weight: bold; color: blue">(<?=$countOr?>) </b></a></li>
                  <?php endif; ?>
                  <li><a href="index.php?r=user/view">Thông tin profile</a></li>
                  <li><a href="index.php?r=user/avatar">Đổi Avatar</a></li>

                  <li role="separator" class="divider"></li>
                  <li><a href="index.php?r=site/logout">Thoát ra</a></li>
                  

              </ul>
            </li>
           
          <?php endif; ?>
           <li>...............</li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    
    

  </nav>








  

  <div class="container">
    <?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
      <?php //echo Alert::widget() ?>
      <?php
   echo Carousel::widget([
    'items' => [
        // the item contains only the image
        '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
        // equivalent to the above
        ['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            
        ],
    ]
]);
?>

      <?= $content ?>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="pull-left">&copy; Copyright <?= date('Y') ?></p>

      <p class="pull-right">Đồ án Tốt Nghiệp - Trần Văn Sỹ</p>
    </div>
  </footer>

  <?php $this->endBody() ?>
  
</body>
</html>
<?php $this->endPage() ?>
