<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý đặt bàn';
$this->params['breadcrumbs'][] = $this->title;
?>





<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo 'Xin chào <span style="color:red;font-weight:bold">'.Yii::$app->user->identity->username.'</span>. Đây là danh sách các đặt bàn từ người dùng'; ?>
</h3>
    </div>
    <div class="panel-body">
        
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
            
            'phone',
          
            'number_people',
            'datetime:datetime',
            //'status',
            [
                'attribute'=>'status',
                'value' => function($model){
                    return '<span class="label label-md label-danger">'.$model->status.'</span>'.
                    '<a href="" title="">Chấp nhận</a>'


                    ;
                },
                'format' =>'html'
            ],
         

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
            'template' => '{delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url ='index.php?r=restaurant/suaor&id='.$model->id;
                return $url;
            }
            if ($action === 'delete') {
                $url ='index.php?r=restaurant/xoaor&id='.$model->id;
                return $url;
            }
           
          }
        ],
  
        ],
    ]); ?>
    </div>
</div>
