<?php
use yii\bootstrap\Carousel;
use backend\models\Restaurant;
use backend\models\Slider;
$Slider = Restaurant::find()->all();

?>

  <?php
echo Carousel::widget([
    'items' => [
        // the item contains only the image
        '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
        // equivalent to the above
        ['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            
        ],
    ]
]);
?>
    


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="/test/backend/web/upload/restaurant33113.jpg" alt="..." height="500px" width="100%">
      <div class="carousel-caption">
       Hệ thống nhà hàng đa dạng
      </div>
    </div>
    <?php foreach ($Slider as $item): ?>
    <div class="item">
      <img src="/test/backend/web/<?=$item->image?>" alt="...">
      <div class="carousel-caption">
         <h3 style=""><?=$item->name?> </h3>
         
      </div>
    </div>
    
<?php endforeach; ?>
    
  </div>

 
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

