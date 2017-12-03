<?php 
use backend\models\Orders;

 $order = Orders::find()
 ->where(['user_id'=>Yii::$app->user->identity->id])
 ->andWhere(['or',['status'=>'Chấp nhận'],['status'=>'Phản đối']])
 ->all();
  ?>
<script type="text/javascript" scr="js/jquery.min.js"></script>
<?php if($order): ?>
<h3 class="text-info" style="color:red">Lịch sử của tôi</h3>
 
    
<div class="span7">   
<div class="widget stacked widget-table action-table">
                    
                <div class="widget-header">
                    <i class="icon-th-list"></i>
                    <h3></h3>
                </div> 
                
                <div class="widget-content">
                    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                
                                <th>Tên nhà hàng</th>
                                <th>Số điện thoại</th>
                                <th>Số người</th>
                                <th>Trạng thái</th>
                                <th>Ngày tháng</th>
                                
                                

            
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($order as $item): ?>
                                
                            <tr>
                                <td><?=$item->restaurant->name?></td>
                                <td><?=$item->phone?></td>
                                <td><?=$item->number_people?></td>
                                <?php if($item->status=="Chờ"): ?>
                                <td><span class="label-lg label label-primary"><?=$item->status?></span></td>
                                <?php elseif($item->status=="Chấp nhận"): ?>
                                <td><span class="label label-success"><?=$item->status?></span></td>
                                <?php else: ?>
                                <td><span class="label label-danger"><?=$item->status?></span></td>
                                <?php endif; ?>
                                <td><?=$item->datetime?></td>
                                
                                
                                
                                
                                
                            </tr>
                        
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    
                </div> <!-- /widget-content -->
            
            </div> <!-- /widget -->
            </div>

            <style type="text/css" media="screen">

                
            </style>
        <?php else: ?>
            <h3>Không có dữ liệu</h3>
        <?php endif; ?>
    