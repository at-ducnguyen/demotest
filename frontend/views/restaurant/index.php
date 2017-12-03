<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý nhà hàng';
$this->params['breadcrumbs'][] = $this->title;
?>





<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo 'Xin chào <span style="color:red;font-weight:bold">'.Yii::$app->user->identity->username.'</span>. Đây là danh sách nhà hàng thuộc quản lý của bạn'; ?>
</h3>
    </div>
    <div class="panel-body">
        <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Thêm Mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'showOnEmpty' => false,
    'emptyText' => '<table><tbody>
    <span class="glyphicon glyphicon-refresh"> </span> Chưa có nhà hàng nào trong danh sách
    </tbody></table>',
        'filterModel' => $searchModel,
        'pager' => array(
     'nextPageLabel' => 'Kế tiếp',
     'prevPageLabel' => 'Quay lại',

     
     ),

        
  'layout' => "{items}\n{pager}",
  
  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'name',
            
            [
              'attribute' => 'address',
              'value'=> function($model){
                return $model->address;
              }
            ],
            'phone',
          
             
            //  [
            //     'attribute'=>'district_id',
            //     'value'=>'district.name',
            //     'headerOptions'=>['style'=>'width:200;text-align:center'],
            //     'contentOptions'=>['style'=>'width:200px;text-align:center']
            //   ],  
            //  ['attribute'=>'city_id','value'=>'district.city.name','headerOptions'=>['style'=>'width:200;text-align:center'],
            //     'contentOptions'=>['style'=>'width:200px;text-align:center']],
         

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
                'copy' => function ($url, $model, $key) {
            return Html::a('Thêm món', ['list', 'id'=>$model->id],['class'=>'btn btn-sm btn-warning']);
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
            'template' => '{update} {view} {delete} {copy}'
        ],
  
        ],
    ]); ?>
    </div>
</div>
