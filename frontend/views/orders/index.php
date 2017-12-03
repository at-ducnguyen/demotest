<?php 
use backend\models\Orders;

 $order = Orders::find()
 ->joinWith(['restaurant c'],true,'INNER JOIN')
 ->where(['c.user_id'=>Yii::$app->user->id])
 ->all();
  ?>
<script type="text/javascript" scr="js/jquery.min.js"></script>
<?php if($order): ?>
<h3 class="text-info" style="color:red">Quản lý đặt bàn</h3>
 <?php foreach($order as $item): ?>
    <?php if($item->status=='Chờ'):  ?> 
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
                                
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Số người</th>
                                <th>Ngày tháng</th>
                                
                                

                                <th class="td-actions">Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                
                            <tr>
                                <td><?=$item->name?></td>
                                <td><?=$item->phone?></td>
                                <td><?=$item->number_people?></td>
                                <td><?=$item->datetime?></td>
                                
                                
                                
                                
                                <td>
                                   <a href="index.php?r=orders/active&id=<?=$item->id?>" title=""><button class="btn btn-success btn-sm">Chấp nhận</button> </a>
                                  <a href="index.php?r=orders/deactive&id=<?=$item->id?>" title=""> <button class="btn btn-danger btn-sm">Phản đối</button> </a>
                                </td>
                            </tr>
                        <?php  endif; ?>
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
    