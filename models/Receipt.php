<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Receipt extends ActiveRecord
{
    public static function tableName()
    {
        return 'receipts';
    }

    public function rules()
    {
        return [
            [['order_id', 'total_amount', 'card_last_digits', 'payment_date'], 'required'],
            [['total_amount'], 'number'],
            [['payment_date', 'created_at'], 'safe'],
            [['order_id'], 'string', 'max' => 50],
            [['card_last_digits'], 'string', 'max' => 4],
            [['status'], 'string', 'max' => 20],
            [['order_id'], 'unique'],
        ];
    }

    public function getItems()
    {
        return $this->hasMany(ReceiptItem::class, ['receipt_id' => 'id']);
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'orderId',
        ]);
    }

    public function getAttributeLabel($attribute)
    {
        $labels = [
            'orderId' => 'Номер заказа',
            'order_id' => 'Номер заказа',
            // ... остальные labels
        ];
        return isset($labels[$attribute]) ? $labels[$attribute] : parent::getAttributeLabel($attribute);
    }

    public static function createFromCart($cartItems, $cardNumber)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $receipt = new Receipt();
            $receipt->order_id = 'ORDER-' . time();
            $receipt->total_amount = array_sum(array_column($cartItems, 'total'));
            $receipt->card_last_digits = substr(preg_replace('/\D/', '', $cardNumber), -4);
            $receipt->payment_date = date('Y-m-d H:i:s');
            $receipt->status = 'Оплачено';

            if ($receipt->save()) {
                foreach ($cartItems as $item) {
                    $receiptItem = new ReceiptItem();
                    $receiptItem->receipt_id = $receipt->id;
                    $receiptItem->product_id = $item['id'];
                    $receiptItem->product_name = $item['name'];
                    $receiptItem->quantity = $item['quantity'];
                    $receiptItem->price = $item['price'];
                    $receiptItem->total = $item['total'];
                    
                    if (!$receiptItem->save()) {
                        throw new \Exception('Ошибка сохранения товара чека');
                    }
                }
                
                $transaction->commit();
                return $receipt;
            }
            throw new \Exception('Ошибка сохранения чека');
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function getFormattedTotal()
    {
        return number_format($this->total_amount, 2, ',', ' ') . ' ₽';
    }

    public function getFormattedDateTime()
    {
        return date('d.m.Y H:i', strtotime($this->payment_date));
    }

    public function getMaskedCardNumber()
    {
        return '**** **** **** ' . $this->card_last_digits;
    }
} 