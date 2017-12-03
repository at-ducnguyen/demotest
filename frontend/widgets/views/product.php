<div class="container mb-5">
        <div class="row">
            <div class="col-md-8">
                <h3 class="display-4 text-center" style="font-weight: bold; color: green">Tìm nhà hàng, địa điểm ăn uống trên toàn quốc</h3>
                <hr class="bg-dark w-25 ml-0">
                
                <span class="label label-danger label-lg" style="margin-left: 100px">THỐNG KÊ CHI TIẾT</span>
                <br>
                
                    <p style="font-weight: bold;color: blue"><i class="glyphicon glyphicon-home"></i> <?php echo \backend\models\Restaurant::find()->count().' nhà hàng địa điểm trên toàn quốc'; ?></p>
                    <p style="font-weight: bold;color: green"><i class="glyphicon glyphicon-user"></i> <?php echo \backend\models\User::find()->count().' người sử dụng'; ?></p>
                    <p style="font-weight: bold;color: red"><i class="glyphicon glyphicon-comment"></i> <?php echo \backend\models\Comment::find()->count().' bình luận'; ?></p>
                    <p style="font-weight: bold;color: orange"><i class="glyphicon glyphicon-star"></i> <?php echo \backend\models\Rating::find()->count().' đánh giá'; ?></p>
                    
                </ul>
                <a href="#" class="btn btn-outline-primary rounded-0"> </a>
            </div>
            <div class="col-md-4 mt-5">
                <img class="card-img-top" src="phone.jpg" alt="Card image cap">
            </div>
        </div>
    </div>
