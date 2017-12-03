<?php

namespace frontend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all User models.
     * @return mixed
     */
    
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {

        return $this->render('view');
    }
    public function actionIndex()
    {

        return $this->render('view');
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = User::find()->where(['id'=>Yii::$app->user->identity->id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('view');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAvatar(){
       
       $model = User::find()->where(['id'=>Yii::$app->user->identity->id])->one();

      
       if ($model->load(Yii::$app->request->post())) {




        $imageName = 'restaurant'.rand(1,100000);

        $model->file=UploadedFile::getInstance($model,'file');
        $model->file->saveAs('upload/'.$imageName.'.'.$model->file->extension);
        $model->avatar= 'upload/'.$imageName.'.'.$model->file->extension;
        
        if ($model->save(false)){
           Yii::$app->session->setFlash('success', 'Đã thêm thành công!');

       };

       return $this->redirect(['view']);
   } else {
    return $this->render('avatar', [
        'model' => $model,
    ]);
}
  
    
}
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
