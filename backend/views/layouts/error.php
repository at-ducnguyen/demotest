

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
   


                <div class="col-md-12 admin-right">
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
