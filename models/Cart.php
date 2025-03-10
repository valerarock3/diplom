<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Cart extends Model
{
    public static function addToCart($productId, $quantity = 1)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        
        $session->set('cart', $cart);
    }

    public static function getCart()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        $products = [];
        
        foreach ($cart as $productId => $quantity) {
            $product = Product::findOne($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'sum' => $product->price * $quantity
                ];
            }
        }
        
        return $products;
    }

    public static function getTotal()
    {
        $cart = self::getCart();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['sum'];
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