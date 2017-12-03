<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $image
 * @property double $no_address
 * @property double $avg_rate
 * @property double $no_rate
 * @property double $no_suggestion
 * @property string $status
 * @property integer $user_id
 * @property integer $city_id
 * @property integer $district_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Comment[] $comments
 * @property Food[] $foods
 * @property Rating[] $ratings
 * @property District $district
 * @property User $user
 * @property RestaurantImage[] $restaurantImages
 * @property RestaurantUser[] $restaurantUsers
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'image','name','city_id','district_id', 'user_id','created_at', 'updated_at'], 'required','message'=>'{attribute} không được để trống !'],
            ['file','file','extensions'=>'jpg,png,gif','skipOnEmpty' => true,'on'=>'update-photo-upload'],
            [['no_address', 'avg_rate', 'no_rate', 'no_suggestion'], 'number'],
            [['user_id', 'city_id', 'district_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'phone', 'image', 'status'], 'string', 'max' => 255],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhà hàng',
            'address' => 'Địa chỉ',
            'phone' => 'Hotline',
            'image' => 'Image',
            'no_address' => 'No Address',
            'avg_rate' => 'Đánh giá',
            'no_rate' => 'No Rate',
            'no_suggestion' => 'No Suggestion',
            'status' => 'Trạng thái',
            'user_id' => 'Người quản lý',
            'city_id' => 'Tỉnh Thành',
            'district_id' => 'Quận Huyện',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file' =>'Hình ảnh'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['restaurant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoods()
    {
        return $this->hasMany(Food::className(), ['restaurant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['restaurant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
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
    public function getRestaurantImages()
    {
        return $this->hasMany(RestaurantImage::className(), ['restaurant_id' => 'id']);
    }
    public function getOrderss()
    {
        return $this->hasMany(Orders::className(), ['restaurant_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantUsers()
    {
        return $this->hasMany(RestaurantUser::className(), ['restaurant_id' => 'id']);
    }

    
}
