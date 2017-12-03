<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Restaurant */

$this->title = 'Cập nhật thông tin';
$this->params['breadcrumbs'][] = ['label' => 'Nhà hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];

?>
<div class="restaurant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
