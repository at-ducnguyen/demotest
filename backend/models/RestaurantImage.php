<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "restaurant_image".
 *
 * @property integer $id
 * @property string $image
 * @property integer $restaurant_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Restaurant $restaurant
 */
class RestaurantImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'restaurant_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'created_at', 'updated_at'], 'required'],
            ['file','file','extensions'=>'jpg,png,gif'],
            [['restaurant_id', 'created_at', 'updated_at'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Hình Ảnh',
            'file' => 'Hình Ảnh',
            'restaurant_id' => 'Nhà hàng',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }
}
