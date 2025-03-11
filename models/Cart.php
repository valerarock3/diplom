<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class Cart extends Model
{
    public static function addToCart($productId)
    {
        // Проверяем существование продукта
        $product = Product::findOne($productId);
        if (!$product) {
            throw new NotFoundHttpException('Товар не найден.');
        }

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }
        
        $session->set('cart', $cart);
        return true;
    }

    public static function getCart()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        $items = [];
        
        foreach ($cart as $productId => $quantity) {
            $product = Product::findOne($productId);
            if ($product) {
                $items[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'category' => $product->category,
                    'image' => $product->image,
                    'total' => $product->price * $quantity
                ];
            }
        }
        
        return $items;
    }

    public static function getTotal()
    {
        $items = self::getCart();
        $total = 0;

        foreach ($items as $item) {
            $total += $item['total'];
        }

        return $total;
    }

    public static function removeFromCart($productId)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $session->set('cart', $cart);
        }
    }

    public static function clearCart()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $session->remove('cart');
    }
} 