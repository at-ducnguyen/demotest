<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
use backend\models\Restaurant;
use backend\models\User;
use backend\models\Comment;
use backend\models\Rating;

$countRes = Restaurant::find()->count();
$countUser = User::find()->count();
$countCm = Comment::find()->count();
$countRa = Rating::find()->count();



$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Admin Control Panel</h1>

        <p class="lead">Chào mừng bạn đến với khu vực dành cho người quản lý</p>

        <p><a class="btn btn-success" href="http://www.yiiframework.com">Thống kê chi tiết</a></p>

    </div>
    <div class="row">
    	
    	
    </div>



    <div class="body-content">

        <div class="col-md-3">
        <div class="panel panel-success">
            <div class="panel-heading">

                <?php echo Html::a('Số Lượng Nhà hàng', ['/restaurant']); ?>

                    <span class="badge pull pull-right"><?php echo $countRes; ?></span>
                </a>

            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    	</div> <!--/col-md-4-->

        <div class="col-md-3">
            <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo Html::a('Số Lượng Người Dùng', ['/user']); ?>
                    <span class="badge pull pull-right"><?php echo $countUser; ?></span>
                </a>

            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
        </div> <!--/col-md-4-->

    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <?php echo Html::a('Số Bình Luận Khách Hàng', ['/contact']); ?>
                    <span class="badge pull pull-right"><?php echo $countCm; ?></span>
                </a>

            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo Html::a('Số Đánh Giá Khách Hàng', ['/contact']); ?>
                    <span class="badge pull pull-right"><?php echo $countRa; ?></span>
                </a>

            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->

    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
