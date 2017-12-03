<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "restaurant_user".
 *
 * @property integer $id
 * @property integer $cookie_id
 * @property integer $user_id
 * @property integer $restaurant_id
 * @property integer $district_id
 * @property double $distance
 * @property double $no_suggestion
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Restaurant $restaurant
 * @property District $district
 */
class RestaurantUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurant_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'restaurant_id', 'district_id','city_id', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'restaurant_id', 'district_id', 'created_at', 'updated_at'], 'required'],
            [['distance', 'no_suggestion'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cookie_id' => 'Cookie ID',
            'city_id' => 'City',
            'user_id' => 'User ID',
            'restaurant_id' => 'Restaurant ID',
            'district_id' => 'District ID',
            'distance' => 'Distance',
            'no_suggestion' => 'No Suggestion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
