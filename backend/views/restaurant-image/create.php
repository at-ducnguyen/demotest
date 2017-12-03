<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestaurantImage */

$this->title = 'Create Restaurant Image';
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
