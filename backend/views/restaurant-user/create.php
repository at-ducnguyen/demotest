<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestaurantUser */

$this->title = 'Create Restaurant User';
$this->params['breadcrumbs'][] = ['label' => 'Restaurant Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
