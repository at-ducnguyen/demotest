<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body>
    <?php $this->beginBody()?>

    <div >
        <!-- <?php
NavBar::begin([
    'brandLabel' => 'Khu vực dành cho người quản trị',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-static-top',
    ],
]);
$menuItems = [
    ['label' => 'Trang chủ', 'url' => ['/site/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
    . Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
        'Logout (' . Yii::$app->user->identity->username . ')',
        ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?> -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php" style="color: blue" >Admin Control Panel</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
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

    
       <li><a href="/test/frontend/web"><span style="color: blue" class="glyphicon glyphicon-home"></span><span style="color: blue"> Trang chủ</span></a></li>
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="color: blue">Danh mục hình ảnh </span><span style="color: blue" class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="index.php?r=slider">Slider</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="index.php?r=restaurant-image">Hình ảnh Nhà hàng</a></li>
        
        
    </ul>
</li>
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="color: blue" class="glyphicon glyphicon-user"></span> <?php echo '<span style="font-weight:bold; color:blue">'. Yii::$app->user->identity->username.'<span>'; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="">Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index.php?r=site/logout">Thoát</a></li>
            </ul
        </li>
        
    </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</div>
<div class="container-fluid">
    <div class="row">
    
            <div class="col-md-2 aside-left">
                <div class="panel panel-primary">

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item active">
                                <span class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-map-marker
                                    "></span> Địa điểm <span class="caret"></span></span>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.php?r=city">Tỉnh - Thành phố</a></li>
                                        <li><a href="index.php?r=district">Quận - Huyện</a></li>

                                    </ul>
                                </li>
                                

                                <li class="list-group-item">
                                    <?php echo Html::a('<span class="glyphicon glyphicon-th-list"></span> Quản lý nhà hàng', ['/restaurant']); ?>

                                </li>
                                <li class="list-group-item">
                                    <?php echo Html::a('<span class="glyphicon glyphicon-fire"></span> Quản lý món ăn', ['/food']); ?>

                                </li>
                               
                                <li class="list-group-item">
                                    <?php echo Html::a('<span class="glyphicon glyphicon-user"></span> Quản lý User', ['/user']); ?>

                                </li>

                                <li class="list-group-item">
                                    <?php echo Html::a('<span class="glyphicon glyphicon-dashboard"></span> Quản lý liên hệ', ['/contact']); ?>

                                </li>

                                <li class="list-group-item">
                                    <?php echo Html::a('<span class="glyphicon glyphicon-comment"></span> Quản lý comment', ['/comment']); ?>

                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                


                <div class="col-md-10 admin-right">
                    <?=Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])?>
                        <?=Alert::widget()?>
                        <?=$content?>
                    </div>
                </div>

            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Copyright <?=date('d-m-Y')?></p>

                <p class="pull-right">Trần Văn Sỹ - 12T1</p>
            </div>
        </footer>

        <?php $this->endBody()?>
    </body>
    </html>
    <?php $this->endPage()?>
