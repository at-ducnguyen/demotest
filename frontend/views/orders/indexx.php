<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý đặt bàn';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách đặt bàn của khách hàng</h3>
    </div>
    <div class="panel-body">
       
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            
            'name',
            'phone',
            'number_people',
             'datetime:datetime',
             'status',
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
            ],
            'template' => '{update} {delete}'
        ],
        ],
    ]); ?>
    </div>
</div>
    
    
    

