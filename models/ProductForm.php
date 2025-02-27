<?php
namespace app\models;

use yii\db\ActiveRecord;

class ProductForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'ProductForm';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'description', 'price', 'image_path'], 'required'],
            [['id', 'price'], 'integer'],
            [['name', 'description', 'image_path'], 'string', 'max' => 255],
        ];
    }
}
