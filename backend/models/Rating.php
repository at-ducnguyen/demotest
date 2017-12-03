<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property double $value
 * @property integer $user_id
 * @property integer $restaurant_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Restaurant $restaurant
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'user_id', 'restaurant_id', 'created_at', 'updated_at'], 'required'],
            [['value'], 'number'],
            [['user_id', 'restaurant_id', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'value' => 'Value',
            'user_id' => 'User ID',
            'restaurant_id' => 'Restaurant ID',
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
}
