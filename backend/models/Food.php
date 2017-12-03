<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $image
 * @property integer $restaurant_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Restaurant $restaurant
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'image','file', 'restaurant_id', 'created_at', 'updated_at'], 'required'],
            [['price'], 'number'],
            ['file','file','extensions'=>'jpg,png,gif'],
            [['restaurant_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
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
            'name' => 'Tên món ăn',
            'price' => 'Giá',
            'image' => 'Hình ảnh',
            'restaurant_id' => 'Nhà hàng',
            'file' => 'Hình Ảnh',
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
