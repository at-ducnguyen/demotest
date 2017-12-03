<?php 
use backend\models\Orders;

 $order = backend\models\Orders::find()
 ->where(['user_id'=>Yii::$app->user->identity->id,'status'=>'Chờ'])
 ->all(); ?>
<script type="text/javascript" scr="js/jquery.min.js"></script>
<?php if($order): ?>
<h3 class="text-info" style="color:red">Đơn hàng đang chờ xử lý</h3>
 
    
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
                                
                                <th>Ngày tháng</th>
                                
                                
<th>Trạng thái</th>
            
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($order as $item): ?>
                                
                            <tr>
                                <td style="color: blue"><?=$item->restaurant->name?></td>
                                <td style="color: blue"><?=$item->phone?></td>
                                <td style="color: blue"><?=$item->number_people?></td>
                                <td style="color: blue"><?=$item->datetime?></td>
                                <td style="color: red">Chờ xử lý</td>
                                
                                
                                
                                
                                
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
    