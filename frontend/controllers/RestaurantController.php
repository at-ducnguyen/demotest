<?php

namespace frontend\controllers;

use Yii;
use backend\models\Restaurant;
use backend\models\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use backend\models\Food;
use backend\models\FoodSearch;
use backend\models\OrdersSearch;


class RestaurantController extends Controller
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }




public function check(){

    if (Yii::$app->user->isGuest){
        return $this->goHome();
    }
}

public function actionOrders(){
if (!Yii::$app->user->isGuest){
         $searchModel = new OrdersSearch();
        //$query = Restaurant::find()->where(['user_id'=>Yii::$app->user->identity->id]);
        $query = \backend\models\Orders::find()->joinWith(['restaurant b'],true,'INNER JOIN')->where(['b.user_id'=>Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
    'query' => $query ,
    'pagination' => [
        'pageSize' => 3,
    ],
]);

        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else
       {
        return $this->goHome();
    }

}


public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
    	 $searchModel = new RestaurantSearch();
        $query = Restaurant::find()->where(['user_id'=>Yii::$app->user->identity->id]);
        $dataProvider = new ActiveDataProvider([
    'query' => $query ,
    'pagination' => [
        'pageSize' => 3,
    ],
]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         }else
       {
        return $this->goHome();
    }
    }

   
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest){
            return $this->goHome();
        }
       $model = new Restaurant();

       if ($model->load(Yii::$app->request->post())) {




        $imageName = 'restaurant'.rand(1,100000);

        $model->file=UploadedFile::getInstance($model,'file');
        $model->file->saveAs('upload/'.$imageName.'.'.$model->file->extension);
        $model->image= 'upload/'.$imageName.'.'.$model->file->extension;
        $model->created_at = time();
        $model->updated_at = time();
        if ($model->save(false)){
           Yii::$app->session->setFlash('success', 'Đã thêm thành công '.$model->name. '!');

       };

       return $this->redirect(['index']);
   } else {
    return $this->render('create', [
        'model' => $model,
    ]);
}
}

public function actionFood($id){

    $model = new Restaurant();
    $Food = new Food();
    if ($Food->load(Yii::$app->request->post())) {

            $imageName = 'food'.rand(1,100000);
            
            $Food->file=UploadedFile::getInstance($Food,'file');
            $Food->file->saveAs('upload/'.$imageName.'.'.$Food->file->extension);
            $Food->image= 'upload/'.$imageName.'.'.$Food->file->extension;
            $Food->created_at = time();
            $Food->updated_at = time();

            if ($Food->save(false)){
                Yii::$app->session->setFlash('warning', 'Đã thêm thành công');
              return $this->render('list', [
            'model' => $this->findModel($id),    
        ]);
                
            }
            
}
return $this->render('food', [
            'model' => $this->findModel($id),
            'Food' => $Food
        ]);
}

public function actionList($id){
 
    $model = new Restaurant();
    return $this->render('list', [
            'model' => $this->findModel($id),    
        ]);

}

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->file){

            $imageName = 'restaurant'.rand(1,100000);
            
            $model->file=UploadedFile::getInstance($model,'file');
            
            $model->file->saveAs('upload/'.$imageName.'.'.$model->file->extension);
       
            $model->image= 'upload/'.$imageName.'.'.$model->file->extension;
        }
           
            $model->updated_at = time();
        

$model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionXoa($id){
        $Food = Food::findOne($id);
        $Food->delete();
        Yii::$app->session->setFlash('success', 'Đã xóa thành công !');

        return $this->redirect(['index']);
    }

public function actionSua($id){
       

        return $this->redirect(['index']);
    }


public function actionXoaor($id){
        $Orders = \backend\models\Orders::findOne($id);
        $Orders->delete();
        Yii::$app->session->setFlash('success', 'Đã xóa thành công !');

        return $this->redirect(['index']);
    }

public function actionSuaor($id){
       

        return $this->redirect(['index']);
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Đã xóa thành công !');

        return $this->redirect(['index']);
    }
 public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
   
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
