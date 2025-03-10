<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Product extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'price'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            ['name', 'string', 'max' => 255],
            ['price', 'number', 'min' => 0],
            ['image', 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название товара',
            'price' => 'Цена',
            'image' => 'Изображение',
            'imageFile' => 'Загрузить изображение',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile) {
                $fileName = 'product_' . time() . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs('uploads/' . $fileName);
                $this->image = $fileName;
                return true;
            }
        }
        return false;
    }
} 