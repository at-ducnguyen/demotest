<?php

namespace backend\controllers;

use Yii;
use backend\models\Restaurant;
use backend\models\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


use yii\filters\AccessControl;
/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }
 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    
[
    'allow'=>true,
    'roles'=>['@'],
    'matchCallback' => function ($rule,$action){
        if (Yii::$app->user->can('admin')){
            return true;
        }

    }
],


                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                    'delete' =>['post'],
                ],
            ],
        ];
    }

    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
   

    /**
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         $dataProvider = new ActiveDataProvider([
//     'query' => Restaurant::find()->orderBy('created_at DESC'),
//     'pagination' => [
//         'pageSize' => 6,
//     ],
// ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
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

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Đã xóa thành công !');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
