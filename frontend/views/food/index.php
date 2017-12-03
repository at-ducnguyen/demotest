<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Food;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

Danh sách món ăn
   

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Món ăn</th>
      <th>Giá tiền</th>
      <th>Hình ảnh</th>
      <th>Tùy chọn</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; ?>
    <?php foreach ($Restaurant as $item): ?>
    <?php $Food = Food::find()->where(['restaurant_id'=>$item->id])->all(); ?>
    <?php foreach ($Food as $key): ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?=$key->name?></td>
      <td><?=$key->price?></td>
      <td><?=$key->image?></td>
      <td>
          <button class="btn btn-primary btn-sm">Sửa</button>
          <button class="btn btn-danger btn-sm">Xóa</button>

      </td>
      
      
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
<?php endforeach; ?>
    
    <tr>
      
  </tbody>
</table>
   

    