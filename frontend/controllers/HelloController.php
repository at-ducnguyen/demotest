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
use backend\models\Restaurant;
use yii\bootstrap\Modal;
use backend\models\User;
use backend\models\RestaurantUser;
use backend\models\City;
use yii\base\Security;

/**
 * Site controller
 */
class HelloController extends Controller
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

    /**
     * @inheritdoc
     */
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

  

public function actionFormSubmission()
    {
        $security = new Security();
        $string = Yii::$app->request->post('string');
        $stringHash = '';
        if (!is_null($string)) {
            $stringHash = $security->generatePasswordHash($string);
        }
        return $this->render('form-submission', [
            'stringHash' => $stringHash,
        ]);
    }


    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            
            $user_id = Yii::$app->user->identity->id;
            $address_user = Yii::$app->user->identity->address;
            if(!empty($address_user)){

                $nameAddress = explode(", ", $address_user);
                $city = City::find()->where('name',$nameAddress[2])->all();
                $address_res = Restaurant::find()->where(['city_id'=>$city->id])->all();
                $ResUser = RestaurantUser::find()->where(['user_id'=>$user_id,'city_id',$city->id]);
                $checkUser = $ResUser->count();
                
                if(!$checkUser) {
                    
                    foreach ($address_res as $address) {
                        $addressTo = $address["address"];

                        $from = urlencode($address_user);
                        $to = urlencode($addressTo);
                        $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
                        $data = json_decode($data);
                        $time = 0;
                        $distance = 0;
                        foreach($data->rows[0]->elements as $road) {
                            $time += $road->duration->value;
                            $distance += $road->distance->value;
                        }
                        $miles = ($distance/1000);
                        if (!empty($miles)) {
                            $dis_result = round((20/$miles),5, PHP_ROUND_HALF_UP);
                        } else {
                            $dis_result = 0;
                        }
                        // dd($dis_result);
                        // $distance = $this->getDistance($address_user, $addressTo);
                        $resuser = new RestaurantUser;
                        $resuser->cookie_id = '';
                        $resuser->user_id = $user->id;
                        $resuser->res_id = $address->id;
                        $resuser->city_id = $city->id;
                        $resuser->distance = $dis_result;
                        $resuser->no_suggestion = ($resuser->distance + $address->no_rate);
                        $resuser->save();
                    }
                        $distance = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('distance', 'desc')->all();
                        $suggestion = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('no_suggestion', 'desc')->all();
                        $res_highlights = Restaurant::find()->where(['city_id'=>$city->id])->orderBy('no_rate', 'desc')->all();
                        $res_propose = [];
                        foreach ($distance as $value) {
                            # code...
                            $res_propose[] = Restaurant::find()->where(['id'=>$value['res_id']])->first();              
                        }
                         $res_prioritize = [];
                        foreach ($suggestion as $value) {
                            $res_prioritize[] =Restaurant::find()->where(['id'=>$value['res_id']])->first();
                        }

                        $city_default = City::find($city->id);
                        return $this->render('index',[
                            'res_highlights' => $res_highlights,
                            'res_prioritize' => $res_prioritize,
                            'res_propose' => $res_propose,
                            'city_default' => $city_default
                        ]);
                }else{
                    $getResUser = $ResUser->all();
                    foreach ($getResUser as $getReUse) {
                        # code...
                        $getNoRate = Restaurant::find()->where(['id'=>$getReUse['res_id'],'city_id'=>$getReUse['city_id']])->first();
                        $getReUse->no_suggestion = ($getReUse['distance'] + $getNoRate->no_rate);
                        $getReUse->save();
                    }
                    $distance = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('distance', 'desc')->all();
                    $suggestion = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('no_suggestion', 'desc')->all();
                    $res_highlights = $res->orderBy('no_rate', 'desc')->all();
                    $res_propose = [];
                    foreach ($distance as $value) {
                        # code...
                        $res_propose[] = Restaurant::find()->where(['id'=>$value['res_id']])->first();              
                    }
                     $res_prioritize = [];
                    foreach ($suggestion as $value) {
                        $res_prioritize[] =Restaurant::find()->where(['id'=>$value['res_id']])->first();
                    }

                    $city_default = City::find($city->id);
                    return $this->render('index',[
                            'res_highlights' => $res_highlights,
                            'res_prioritize' => $res_prioritize,
                            'res_propose' => $res_propose,
                            'city_default' => $city_default
                        ]);
                }
            }else{
                $city_default = City::find()->where(['id'=>3])->one();
                
        
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }

    
                $cookie_id =  $_COOKIE['PHPSESSID'];
                $res = Restaurant::find()->where(['city_id'=>$city_default->id]);
                $address_res = $res->all();

                $distance = RestaurantUser::find()->where(['cookie_id'=> $cookie_id,'city_id'=>$city_default->id])->orderBy('distance', 'desc')->all();
                $suggestion = RestaurantUser::find()->where(['cookie_id'=> $cookie_id,'city_id'=>$city_default->id])->orderBy('no_suggestion', 'desc')->all();
                $res_highlights = $res->orderBy('no_rate', 'desc')->all();
                $res_propose = [];
                foreach ($distance as $value) {
                    # code...
                    $res_propose[] = Restaurant::find()->where(['id'=>$value['res_id']])->first();              
                }
                 $res_prioritize = [];
                foreach ($suggestion as $value) {
                    $res_prioritize[] =Restaurant::find()->where(['id'=>$value['res_id']])->first();
                }


                return $this->render('index',[
                            'res_highlights' => $res_highlights,
                            'res_prioritize' => $res_prioritize,
                            'res_propose' => $res_propose,
                            'city_default' => $city_default
                        ]);
            }  


             
        }else{
            $city_default = City::find(3);
            session_start();
            $cookie_id =  $_COOKIE["PHPSESSID"];
            $res = Restaurant::find()->where(['city_id'=>$city_default->id]);
            $address_res = $res->all();

            $distance = RestaurantUser::find()->where(['cookie_id' => $cookie_id,'city_id'=>$city_default->id])->orderBy('distance', 'desc')->get();
            $suggestion = RestaurantUser::find()->where(['cookie_id'=>$cookie_id,'city_id'=>$city_default->id])->orderBy('no_suggestion', 'desc')->all();
            $res_highlights = $res->orderBy('no_rate', 'desc')->all();
            $res_propose = [];
            foreach ($distance as $value) {
                # code...
                $res_propose[] = Restaurant::find()->where(['id',$value['res_id']])->first();              
            }
             $res_prioritize = [];
            foreach ($suggestion as $value) {
                $res_prioritize[] =Restaurant::find()->where(['id'=>$value['res_id']])->first();
            }


            return $this->render('index',[
                            'res_highlights' => $res_highlights,
                            'res_prioritize' => $res_prioritize,
                            'res_propose' => $res_propose,
                            'city_default' => $city_default
                        ]);
        }
        
    }

    
    
public function actionTest()
    {
        if(!Yii::$app->user->isGuest){
            
            $user_id = Yii::$app->user->identity->id;
            $address_user = Yii::$app->user->identity->address;
            if(!empty($address_user)){


                echo $address_user;
                echo '<br>';               
                 $nameAddress = explode(", ", $address_user);
                 echo $nameAddress[2];

                $city = City::find()->where(['name'=>'Đà Nẵng'])->one();
                $address_res = Restaurant::find()->where(['city_id'=>$city->id])->all();
                $ResUser = RestaurantUser::find()->where(['user_id'=>$user_id,'city_id'=>$city->id]);
                $checkUser = $ResUser->count();

                if(!$checkUser) {
                    

                   
                     foreach ($address_res as $address) {
                        $addressTo = $address['address'];// của Restaurant

                         $from = urlencode($address_user);
                         $to = urlencode($addressTo);
                         $data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
                         $data = json_decode($data);
                         $time = 0;
                         $distance = 0;
                         foreach($data->rows[0]->elements as $road) {
                            $time += $road->duration->value;
                             $distance += $road->distance->value;
                         }
                         $miles = ($distance/1000);
                         if (!empty($miles)) {
                             $dis_result = round((20/$miles),5, PHP_ROUND_HALF_UP);
                        } else {
                            $dis_result = 0;
                        }
                       
                         $resuser = new RestaurantUser;
                         $resuser->cookie_id = '';
                         $resuser->user_id = $user->id;
                         $resuser->res_id = $address->id;
                         $resuser->city_id = $city->id;
                         $resuser->distance = $dis_result;
                         $resuser->no_suggestion = ($resuser->distance + $address->no_rate);
                         $resuser->save();
                     }
                    //     $distance = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('distance', 'desc')->all();
                    //     $suggestion = RestaurantUser::find()->where(['user_id'=> $user_id,'city_id'=>$city->id])->orderBy('no_suggestion', 'desc')->all();
                    //     $res_highlights = Restaurant::find()->where(['city_id'=>$city->id])->orderBy('no_rate', 'desc')->all();
                    //     $res_propose = [];
                    //     foreach ($distance as $value) {
                    //         # code...
                    //         $res_propose[] = Restaurant::find()->where(['id'=>$value['res_id']])->first();              
                    //     }
                    //      $res_prioritize = [];
                    //     foreach ($suggestion as $value) {
                    //         $res_prioritize[] =Restaurant::find()->where(['id'=>$value['res_id']])->first();
                    //     }

                    //     $city_default = City::find($city->id);
                    //     return $this->render('index',[
                    //         'res_highlights' => $res_highlights,
                    //         'res_prioritize' => $res_prioritize,
                    //         'res_propose' => $res_propose,
                    //         'city_default' => $city_default
                    //     ]);
                }




                
                 
                 
                
                
               
                
            }
        }
    
        }












public function actionHello()
{
    
 
            
        


    return $this->render('hello');

}












   }
