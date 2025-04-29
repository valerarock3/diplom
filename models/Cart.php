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
            if (is_array($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                // Преобразуем старый формат в новый
                $cart[$productId] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1
                ];
            }
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
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
        
        foreach ($cart as $productId => $item) {
            $product = Product::findOne($productId);
            if ($product) {
                if (is_array($item)) {
                    $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                } else {
                    $quantity = $item;
                }
                
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

    public static function normalizeCart()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        
        $cart = $session->get('cart', []);
        $normalizedCart = [];
        
        foreach ($cart as $productId => $item) {
            $product = Product::findOne($productId);
            if ($product) {
                if (is_array($item)) {
                    $normalizedCart[$productId] = $item;
                } else {
                    $normalizedCart[$productId] = [
                        'id' => $productId,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => (int)$item
                    ];
                }
            }
        }
        
        $session->set('cart', $normalizedCart);
        return true;
    }
} 