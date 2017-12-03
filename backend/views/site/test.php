<?php 
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\City;
use backend\models\District;
 ?>
 <h1>Test Dropdown</h1>
 <div class="col-md-4">
 	<label>Thành phố</label>
 	<?php $item = ArrayHelper::map(City::find()->all(),'id','name'); ?>

 	 
 	
 </div>