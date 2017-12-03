<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
       
    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Thêm Mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header'=>'STT',
            'contentOptions'=>['style'=>'text-align:center']
        ],

            //'id',
            'image',
            'created_at:date',
            'updated_at:date',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Tùy chọn',
            'headerOptions'=>['style'=>'text-align:center'],
            'contentOptions'=>['style'=>'text-align:center'],

            'buttons'=>[
                'view' =>function ($url,$model) {
                    return Html::a('Xem',$url,['class'=>'btn btn-xs btn-primary']);
                },
                'update' =>function ($url,$model) {
                    return Html::a('Sửa',$url,['class'=>'btn btn-xs btn-success']);
                },
                'delete' =>function ($url,$model) {
                    return Html::a('Xóa',$url,
                        ['class'=>'btn btn-xs btn-danger',
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