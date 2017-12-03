<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'address',
            'phone',
            'image',
            //[
        //'attribute'=>'image',
        //'value'=>$model->image,
        //'format' => ['image',['width'=>'400','height'=>'400']],
        
            //],
            //'no_address',
            //'avg_rate',
            //'no_rate',
            //'no_suggestion',
            'status',
            //'user_id',
            //'city_id',
            [
                'attribute'=>'city_id',
                'value' => $model->district->city->name
            ],
            //'district_id',
            [
                'attribute' => 'district_id',
                'value' => $model->district->name
            ]
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
