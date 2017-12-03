<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'created_at','file', 'updated_at'], 'required'],
            ['file','file','extensions'=>'jpg,png,gif'],
            [['created_at', 'updated_at'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Hình ảnh',
            'file' => 'Hình ảnh',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
