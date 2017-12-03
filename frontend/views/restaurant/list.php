<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\models\Food;
use backend\models\FoodSearch;



$this->title = 'Món ăn';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 

$query = Food::find()->where(['restaurant_id'=>$model->id]);

$searchModel = new FoodSearch();
        $dataProvider = new ActiveDataProvider([
    'query' => $query ,
    'pagination' => [
        'pageSize' => 6,
    ],
]);

 ?>



    <h1></h1>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách món ăn</h3>
        </div>
        <div class="panel-body">
            <p class="pull-right">
        <a href="index.php?r=restaurant%2Ffood&id=<?php echo $model->id; ?>" title=""><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Món</button></a>
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
                'xoa' =>function ($url,$model) {
                    return Html::a('Xóa',$url,['class'=>'btn btn-sm btn-danger']);
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
            'template' => '{update} {xoa}',
            'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'xoa') {
                $url ='index.php?r=restaurant/xoa&id='.$model->id;
                return $url;
            }
            if ($action === 'update') {
                $url ='index.php?r=restaurant/sua&id='.$model->id;
                return $url;
            }
           
          }
          
        ],
        ],
    ]); ?>


        </div>
    </div>
    
