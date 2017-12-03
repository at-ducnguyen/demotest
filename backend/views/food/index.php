<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Món ăn';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1></h1>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách món ăn</h3>
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
            'name',
            //'price',
            [
                'attribute'=>'price',
                'value' => function ($model){
                    return number_format($model->price).' VNĐ';
                }
            ],
            //'image',
            //'restaurant_id',
            [
                'attribute'=>'restaurant_id',
                'value' => 'restaurant.name'
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Tùy chọn',
            'headerOptions'=>['style'=>'text-align:center'],
            'contentOptions'=>['style'=>'text-align:center'],

            'buttons'=>[
                'view' =>function ($url,$model) {
                    return Html::a('Xem',$url,['class'=>'btn btn-sm btn-primary']);
                },
                'update' =>function ($url,$model) {
                    return Html::a('Sửa',$url,['class'=>'btn btn-sm btn-success']);
                },
                'delete' =>function ($url,$model) {
                    return Html::a('Xóa',$url,
                        ['class'=>'btn btn-sm btn-danger',
                        'data-confirm'=>'Bạn có chắc chắn muốn xóa không?',
                        'data-method'=>'post'
                        ]
                    );
                },
            ]
        ],
        ],
    ]); ?>


        </div>
    </div>
    
    