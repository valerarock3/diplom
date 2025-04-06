<?php

namespace app\models;

use yii\db\ActiveRecord;

class ReceiptItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'receipt_items';
    }

    public function rules()
    {
        return [
            [['receipt_id', 'product_id', 'product_name', 'quantity', 'price', 'total'], 'required'],
            [['receipt_id', 'product_id', 'quantity'], 'integer'],
            [['price', 'total'], 'number'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    public function getReceipt()
    {
        return $this->hasOne(Receipt::class, ['id' => 'receipt_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
} 