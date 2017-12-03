<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý nhà hàng';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách nhà hàng</h3>
    </div>
    <div class="panel-body">
        <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Thêm Mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => array(
     'nextPageLabel' => 'Kế tiếp',
     'prevPageLabel' => 'Quay lại',

     
     ),

        
  'layout' => "{items}\n{pager}",
  
  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'address',
            [
              'attribute' => 'address',
              'value'=> function($model){
                return $model->address;
              }
            ],
            //'phone',
            //'image:image',
            // 'no_address',
             'avg_rate',
            // 'no_rate',
            // 'no_suggestion',
            // 'status',
             //'user_id',
             [
                'attribute'=>'user_id',
                'value'=>'user.username',
                'headerOptions'=>['style'=>'width:150px;text-align:center'],
                'contentOptions'=>['style'=>'width:150px;text-align:center']
            ],
             // [
             //    'attribute'=>'district_id',
             //    'value'=>'district.name',
             //    'headerOptions'=>['style'=>'width:200;text-align:center'],
             //    'contentOptions'=>['style'=>'width:200px;text-align:center']
             //  ],  
             // ['attribute'=>'city_id','value'=>'district.city.name','headerOptions'=>['style'=>'width:200;text-align:center'],
             //    'contentOptions'=>['style'=>'width:200px;text-align:center']],
             //'city_id',
             //'district_id',
            'created_at:date',
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
  //               [
  //   'format'=>'html',
  //   'content'=>function($data,$url) {
  //       $btn = ButtonDropdown::widget([
  //       'label' => 'Action',
  //       'options' => ['class'=>'btn btn-sm btn-danger dropdown-toggle', 'type'=>'button'],
  //       'dropdown' => [
  //           'options' => ['class'=>'dropdown-menu action', 'role'=>'menu'],
  //           'items' => [
  //             ['label' => 'Chi tiết', 'url' =>  ['view','id'=>$data->id], 
  //                     'linkOptions' => ['class'=>'fa fa-pencil'],],
  //             ['label' => 'Sửa', 'url' =>  ['update','id'=>$data->id], 
  //                     'linkOptions' => ['class'=>'fa fa-eye'],],
             
  //             ['label' => 'Xóa', 'url' =>  ['delete','id'=>$data->id], 
  //                     'linkOptions' => ['class'=>'fa fa-trash' , ['data' => [
  //                   'confirm' => 'Are you sure ?',
  //                   'method' => 'post',
  //               ]]],],                 
  //           ],
  //       ],
  //   ]);
  //   return $btn;
  // },
  // ],
        ],
    ]); ?>
    </div>
</div>
