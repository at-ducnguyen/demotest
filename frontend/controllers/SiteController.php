<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Comment;
use backend\models\Rating;
use backend\models\Food;
use backend\models\Orders;
use backend\models\Contact;
use backend\models\Restaurant;
use backend\models\City;
use backend\models\District;
use yii\data\Pagination;
use yii\bootstrap\Modal;
use shirase\vote\actions\VoteAction;
use shirase\vote\models\Vote;
use yii\web\UploadedFile;
use yii\web\HttpException;
use common\models\User;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    
    public function actionList(){
   $query = Restaurant::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $Restaurant = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('list', [
            'Restaurant' => $Restaurant,
            'pagination' => $pagination,
        ]);


}
public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}
    public function actions()
    {
        return [
            
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionSearch(){
        return $this->render('search');
    }

    public function actionView($id){
if (Yii::$app->user->isGuest){
    return $this->goHome();
}


        $Comment = new Comment();
        $Rating = new Rating();
        $Orders = new Orders();
        $Restaurant = Restaurant::findOne(['id'=>$id]);
        if ($Comment->load(Yii::$app->request->post())) {
            $Comment->created_at = time();
            $Comment->updated_at = time();

            if ($Comment->save(false)){
                $countComment = Comment::find()->where(['restaurant_id'=>$Restaurant->id])->count();
            $Restaurant->num_comment = $countComment;
            $Restaurant->save();
                Yii::$app->session->setFlash('warning', 'Đã gửi bình luận');
                return $this->refresh();
            }
            
}

if ($Orders->load(Yii::$app->request->post())) {
            $Orders->created_at = time();
            $Orders->updated_at = time();

            if ($Orders->save(false)){
                Yii::$app->session->setFlash('primary', 'Đã đặt bàn thành công');
                return $this->refresh();
            }
            
}

if ($Rating->load(Yii::$app->request->post())) {
    $check = Rating::find()->where(['user_id'=>Yii::$app->user->identity->id,'restaurant_id'=>$Restaurant->id])->count();

    if ($check > 0)
        {
            Yii::$app->session->setFlash('danger', 'Thất bại, bạn đã đánh giá rồi!');
        }else {
            $Rating->created_at = time();
            $Rating->updated_at = time();

            if ($Rating->save(false)){

    $Res = Rating::find()->where(['restaurant_id'=>$Restaurant->id])->all();
    $count = Rating::find()->where(['restaurant_id'=>$Restaurant->id])->count();
    
    $sum = 0;
    foreach ($Res as $key) {
    $sum = $sum + $key->value;
  } 
 $Restaurant->avg_rate = number_format($sum/$count,2);
 $Restaurant->num_rate = $count; 
 $Restaurant->save();
  Yii::$app->session->setFlash('success', 'Bạn đã đánh giá cho nhà hàng này');
                
                return $this->refresh();
            }
        }
            
}


    return $this->render('view',[
            'Restaurant' => $Restaurant,
            'Comment' => $Comment,
            'Rating' => $Rating,
            'Orders' => $Orders
            ]);

}
    

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
$model = new Restaurant; 
$postRes = Yii::$app->request->post('Restaurant');
 $result = Restaurant::find()->all();
if (!Yii::$app->user->isGuest){
$user_id = Yii::$app->user->identity->id;
            $address_user = Yii::$app->user->identity->address;
            if(!empty($address_user)){

                $nameAddress = explode(", ", $address_user);
                $city = City::findOne(['name'=>$nameAddress[2]]);
                    if ($city) {
                $Res_Hight = Restaurant::find()->where(['city_id'=>$city->id])->orderBy('avg_rate DESC')->all();
                $Res_TopComment = Restaurant::find()->where(['city_id'=>$city->id])->orderBy('num_comment DESC')->all();
                    }else {
                        $Res_Hight = Restaurant::find()->orderBy('avg_rate DESC')->all();
                    $Res_TopComment = Restaurant::find()->orderBy('num_comment DESC')->all();
                    }
                } 
                else {
                    $Res_Hight = Restaurant::find()->orderBy('avg_rate DESC')->all();
                    $Res_TopComment = Restaurant::find()->orderBy('num_comment DESC')->all();

                }

    
}
    else {
        $Res_Hight = Restaurant::find()->orderBy('avg_rate DESC')->all();
        $Res_TopComment = Restaurant::find()->orderBy('num_comment DESC')->all();
    }


$Res_TopRate = Restaurant::find()->orderBy('num_rate DESC')->all();


        return $this->render('index',[
            'Res_Hight' => $Res_Hight,
            'model'=>$model,
        'result' => $result,
        'postRes'=>$postRes,

        'Res_TopComment'=> $Res_TopComment,
        'Res_TopRate'=> $Res_TopRate

        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionAjaxLogin() {
    if (Yii::$app->request->isAjax) {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->goBack();
            } else {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
            }
        }
    } else {
        throw new HttpException(404 ,'Page not found');
    }
}

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $contact = new Contact();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post()['ContactForm'];
            $contact->created_at = time();
           

            $contact->name = $post['name'];
            $contact->email = $post['email'];
            
            $contact->subject = $post['subject'];
            $contact->body = $post['body'];
           
            $contact->save(false);
           
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

        
            

        


           
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
             }
         }

         return $this->render('signup', [
             'model' => $model,
         ]);
    }

    public function actionTest(){
        return $this->render('test');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
