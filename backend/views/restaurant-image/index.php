<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestaurantImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hình Ảnh Nhà Hàng';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Danh mục hình ảnh nhà hàng</h3>
    </div>
    <div class="panel-body">
        <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Thêm Mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'image',
            //'restaurant_id',
            [
                'attribute'=>'restaurant_id',
                'value' => 'restaurant.name'
            ],
            'created_at:date',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>