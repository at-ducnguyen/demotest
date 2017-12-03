<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        //Restaurant
         $indexRestaurant = $auth->createPermission('indexRestaurant');
         $indexRestaurant->description = 'index Restaurant';
         $auth->add($indexRestaurant);

         $updateRestaurant = $auth->createPermission('updateRestaurant');
         $updateRestaurant->description = 'Update Restaurant';
         $auth->add($updateRestaurant);

         $viewRestaurant = $auth->createPermission('viewRestaurant');
         $viewRestaurant->description = 'view Restaurant';
         $auth->add($viewRestaurant);

         $deleteRestaurant = $auth->createPermission('deleteRestaurant');
         $deleteRestaurant->description = 'delete Restaurant';
        $auth->add($deleteRestaurant);

        $createRestaurant = $auth->createPermission('createRestaurant');
        $createRestaurant->description = 'create Restaurant';
         $auth->add($createRestaurant);

//City
         $indexCity = $auth->createPermission('indexCity');
         $indexCity->description = 'index City';
         $auth->add($indexCity);

         $updateCity = $auth->createPermission('updateCity');
         $updateCity->description = 'Update City';
         $auth->add($updateCity);

         $viewCity = $auth->createPermission('viewCity');
         $viewCity->description = 'view City';
         $auth->add($viewCity);

         $deleteCity = $auth->createPermission('deleteCity');
         $deleteCity->description = 'delete City';
        $auth->add($deleteCity);

        $createCity = $auth->createPermission('createCity');
        $createCity->description = 'create City';
         $auth->add($createCity);
//District

        $indexDistrict = $auth->createPermission('indexDistrict');
         $indexDistrict->description = 'index District';
         $auth->add($indexDistrict);

         $updateDistrict = $auth->createPermission('updateDistrict');
         $updateDistrict->description = 'Update District';
         $auth->add($updateDistrict);

         $viewDistrict = $auth->createPermission('viewDistrict');
         $viewDistrict->description = 'view District';
         $auth->add($viewDistrict);

         $deleteDistrict = $auth->createPermission('deleteDistrict');
         $deleteDistrict->description = 'delete District';
        $auth->add($deleteDistrict);

        $createDistrict = $auth->createPermission('createDistrict');
        $createDistrict->description = 'create District';
         $auth->add($createDistrict);
        //Food
         $indexFood = $auth->createPermission('indexFood');
         $indexFood->description = 'index Food';
         $auth->add($indexFood);

         $updateFood = $auth->createPermission('updateFood');
         $updateFood->description = 'Update Food';
         $auth->add($updateFood);

         $viewFood = $auth->createPermission('viewFood');
         $viewFood->description = 'view Food';
         $auth->add($viewFood);

         $deleteFood = $auth->createPermission('deleteFood');
         $deleteFood->description = 'delete Food';
        $auth->add($deleteFood);

        $createFood = $auth->createPermission('createFood');
        $createFood->description = 'create Food';
         $auth->add($createFood);
         //User
         $indexUser = $auth->createPermission('indexUser');
         $indexUser->description = 'index User';
         $auth->add($indexUser);

         $updateUser = $auth->createPermission('updateUser');
         $updateUser->description = 'Update User';
         $auth->add($updateUser);

         $viewUser = $auth->createPermission('viewUser');
         $viewUser->description = 'view User';
         $auth->add($viewUser);

         $deleteUser = $auth->createPermission('deleteUser');
         $deleteUser->description = 'delete User';
        $auth->add($deleteUser);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'create User';
         $auth->add($createUser);
         //Comment
         $indexComment = $auth->createPermission('indexComment');
         $indexComment->description = 'index Comment';
         $auth->add($indexComment);

         $updateComment = $auth->createPermission('updateComment');
         $updateComment->description = 'Update Comment';
         $auth->add($updateComment);

         $viewComment = $auth->createPermission('viewComment');
         $viewComment->description = 'view Comment';
         $auth->add($viewComment);

         $deleteComment = $auth->createPermission('deleteComment');
         $deleteComment->description = 'delete Comment';
        $auth->add($deleteComment);

        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'create Comment';
         $auth->add($createComment);
         //Rating
         $indexRating = $auth->createPermission('indexRating');
         $indexRating->description = 'index Rating';
         $auth->add($indexRating);

         $updateRating = $auth->createPermission('updateRating');
         $updateRating->description = 'Update Rating';
         $auth->add($updateRating);

         $viewRating = $auth->createPermission('viewRating');
         $viewRating->description = 'view Rating';
         $auth->add($viewRating);

         $deleteRating = $auth->createPermission('deleteRating');
         $deleteRating->description = 'delete Rating';
        $auth->add($deleteRating);

        $createRating = $auth->createPermission('createRating');
        $createRating->description = 'create Rating';
         $auth->add($createRating);
         //Orders
         $indexOrders = $auth->createPermission('indexOrders');
         $indexOrders->description = 'index Orders';
         $auth->add($indexOrders);

         $updateOrders = $auth->createPermission('updateOrders');
         $updateOrders->description = 'Update Orders';
         $auth->add($updateOrders);

         $viewOrders = $auth->createPermission('viewOrders');
         $viewOrders->description = 'view Orders';
         $auth->add($viewOrders);

         $deleteOrders = $auth->createPermission('deleteOrders');
         $deleteOrders->description = 'delete Orders';
        $auth->add($deleteOrders);

        $createOrders = $auth->createPermission('createOrders');
        $createOrders->description = 'create Orders';
         $auth->add($createOrders);
         //Restauimae
         $indexRestaurantImage = $auth->createPermission('indexRestaurantImage');
         $indexRestaurantImage->description = 'index RestaurantImage';
         $auth->add($indexRestaurantImage);

         $updateRestaurantImage = $auth->createPermission('updateRestaurantImage');
         $updateRestaurantImage->description = 'Update RestaurantImage';
         $auth->add($updateRestaurantImage);

         $viewRestaurantImage = $auth->createPermission('viewRestaurantImage');
         $viewRestaurantImage->description = 'view RestaurantImage';
         $auth->add($viewRestaurantImage);

         $deleteRestaurantImage = $auth->createPermission('deleteRestaurantImage');
         $deleteRestaurantImage->description = 'delete RestaurantImage';
        $auth->add($deleteRestaurantImage);

        $createRestaurantImage = $auth->createPermission('createRestaurantImage');
        $createRestaurantImage->description = 'create RestaurantImage';
         $auth->add($createRestaurantImage);
         //Slider
         $indexSlider = $auth->createPermission('indexSlider');
         $indexSlider->description = 'index Slider';
         $auth->add($indexSlider);

         $updateSlider = $auth->createPermission('updateSlider');
         $updateSlider->description = 'Update Slider';
         $auth->add($updateSlider);

         $viewSlider = $auth->createPermission('viewSlider');
         $viewSlider->description = 'view Slider';
         $auth->add($viewSlider);

         $deleteSlider = $auth->createPermission('deleteSlider');
         $deleteSlider->description = 'delete Slider';
        $auth->add($deleteSlider);

        $createSlider = $auth->createPermission('createSlider');
        $createSlider->description = 'create Slider';
         $auth->add($createSlider);
         //Slider
         $indexContact = $auth->createPermission('indexContact');
         $indexContact->description = 'index Contact';
         $auth->add($indexContact);

         $updateContact = $auth->createPermission('updateContact');
         $updateContact->description = 'Update Contact';
         $auth->add($updateContact);

         $viewContact = $auth->createPermission('viewContact');
         $viewContact->description = 'view Contact';
         $auth->add($viewContact);

         $deleteContact = $auth->createPermission('deleteContact');
         $deleteContact->description = 'delete Contact';
        $auth->add($deleteContact);

        $createContact = $auth->createPermission('createContact');
        $createContact->description = 'create Contact';
         $auth->add($createContact);
         //Slider
         $indexRestaurantUser = $auth->createPermission('indexRestaurantUser');
         $indexRestaurantUser->description = 'index RestaurantUser';
         $auth->add($indexRestaurantUser);

         $updateRestaurantUser = $auth->createPermission('updateRestaurantUser');
         $updateRestaurantUser->description = 'Update RestaurantUser';
         $auth->add($updateRestaurantUser);

         $viewRestaurantUser = $auth->createPermission('viewRestaurantUser');
         $viewRestaurantUser->description = 'view RestaurantUser';
         $auth->add($viewRestaurantUser);

         $deleteRestaurantUser = $auth->createPermission('deleteRestaurantUser');
         $deleteRestaurantUser->description = 'delete RestaurantUser';
        $auth->add($deleteRestaurantUser);

        $createRestaurantUser = $auth->createPermission('createRestaurantUser');
        $createRestaurantUser->description = 'create RestaurantUser';
         $auth->add($createRestaurantUser);





       
          $admin = $auth->createRole('admin');
          $auth->add($admin);
         $auth->addChild($admin, $updateRestaurant);
         $auth->addChild($admin, $indexRestaurant);
         $auth->addChild($admin, $viewRestaurant);
         $auth->addChild($admin, $deleteRestaurant);
         $auth->addChild($admin, $createRestaurant);

         $auth->addChild($admin, $updateCity);
         $auth->addChild($admin, $indexCity);
         $auth->addChild($admin, $viewCity);
         $auth->addChild($admin, $deleteCity);
         $auth->addChild($admin, $createCity);

         $auth->addChild($admin, $updateDistrict);
         $auth->addChild($admin, $indexDistrict);
         $auth->addChild($admin, $viewDistrict);
         $auth->addChild($admin, $deleteDistrict);
         $auth->addChild($admin, $createDistrict);

         $auth->addChild($admin, $updateComment);
         $auth->addChild($admin, $indexComment);
         $auth->addChild($admin, $viewComment);
         $auth->addChild($admin, $deleteComment);
         $auth->addChild($admin, $createComment);

         $auth->addChild($admin, $updateRating);
         $auth->addChild($admin, $indexRating);
         $auth->addChild($admin, $viewRating);
         $auth->addChild($admin, $deleteRating);
         $auth->addChild($admin, $createRating);

         $auth->addChild($admin, $updateFood);
         $auth->addChild($admin, $indexFood);
         $auth->addChild($admin, $viewFood);
         $auth->addChild($admin, $deleteFood);
         $auth->addChild($admin, $createFood);

         $auth->addChild($admin, $updateRestaurantImage);
         $auth->addChild($admin, $indexRestaurantImage);
         $auth->addChild($admin, $viewRestaurantImage);
         $auth->addChild($admin, $deleteRestaurantImage);
         $auth->addChild($admin, $createRestaurantImage);

         $auth->addChild($admin, $updateSlider);
         $auth->addChild($admin, $indexSlider);
         $auth->addChild($admin, $viewSlider);
         $auth->addChild($admin, $deleteSlider);
         $auth->addChild($admin, $createSlider);

         $auth->addChild($admin, $updateContact);
         $auth->addChild($admin, $indexContact);
         $auth->addChild($admin, $viewContact);
         $auth->addChild($admin, $deleteContact);
         $auth->addChild($admin, $createContact);

         $auth->addChild($admin, $updateOrders);
         $auth->addChild($admin, $indexOrders);
         $auth->addChild($admin, $viewOrders);
         $auth->addChild($admin, $deleteOrders);
         $auth->addChild($admin, $createOrders);

         $auth->addChild($admin, $updateRestaurantUser);
         $auth->addChild($admin, $indexRestaurantUser);
         $auth->addChild($admin, $viewRestaurantUser);
         $auth->addChild($admin, $deleteRestaurantUser);
         $auth->addChild($admin, $createRestaurantUser);
        

        
        
         $auth->assign($admin, 1);
    }
}