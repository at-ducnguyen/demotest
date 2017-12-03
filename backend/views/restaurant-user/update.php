<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RestaurantUser */

$this->title = 'Update Restaurant User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="restaurant-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
