<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

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
            [['name', 'price', 'category'], 'required', 'message' => 'Поле {attribute} обязательно для заполнения'],
            [['price'], 'number', 'message' => 'Цена должна быть числом'],
            [['name', 'category', 'image'], 'string', 'max' => 255],
            ['description', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
            'category' => 'Категория',
            'image' => 'Изображение',
            'description' => 'Описание',
            'imageFile' => 'Загрузить изображение',
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            // Если файл не загружен, пропускаем валидацию
            if ($this->imageFile === null) {
                return true;
            }
            return true;
        }
        return false;
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile) {
                // Создаем директорию, если она не существует
                $uploadPath = \Yii::getAlias('@webroot/uploads');
                if (!file_exists($uploadPath)) {
                    FileHelper::createDirectory($uploadPath, 0777, true);
                }

                $fileName = 'product_' . time() . '.' . $this->imageFile->extension;
                if ($this->imageFile->saveAs($uploadPath . '/' . $fileName)) {
                    $this->image = $fileName;
                    return true;
                }
            }
            return true; // Возвращаем true если нет файла для загрузки
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Отладочная информация
        Yii::debug('Сохранение товара: ' . print_r($this->attributes, true));
        
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::debug('Товар сохранен. ID: ' . $this->id);
    }
} 