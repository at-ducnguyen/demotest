<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $restaurant_id
 * @property string $name
 * @property string $phone
 * @property integer $number_people
 * @property string $datetime
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Restaurant $restaurant
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'name', 'phone', 'number_people', 'datetime', 'created_at', 'updated_at'], 'required','message'=>'{attribute} không được để trống'],
            [['restaurant_id', 'number_people', 'created_at', 'updated_at'], 'integer'],
            [['datetime'], 'safe'],
            [['status'], 'string'],
            [['name', 'phone'], 'string', 'max' => 225],
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
            'restaurant_id' => 'Nhà hàng',
            'name' => 'Tên khách hàng',
            'phone' => 'Số điện thoại',
            'number_people' => 'Số người',
            'datetime' => 'Ngày tháng',
            'status' => 'Status',
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
