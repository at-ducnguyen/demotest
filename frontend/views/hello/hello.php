<?php 
use backend\models\Restaurant;
use backend\models\City;
use backend\models\Orders;



$carts = Orders::find()
    ->joinWith('restaurant',false,'INNER JOIN') // the relation name
    ->where(['restaurant.user_id'=>Yii::$app->user->identity->id,'orders.status'=>'Chờ'])
->count();

echo $carts;



?>


		