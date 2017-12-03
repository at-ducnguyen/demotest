<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Restaurant */

$this->title = 'Thêm Mới';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-create">

    <h1></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
