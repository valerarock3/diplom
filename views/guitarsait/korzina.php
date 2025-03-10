<?php
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="rew.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="sait">
        <div class="header">
            <?= Html::a('Домашняя страница', ['home'], ['class' => 'home-link']) ?>
            <h1>Корзина</h1>
            
            <?php if (!empty($cartItems)): ?>
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <div class="product-image">
                                <?= Html::img('@web/images/products/' . $item['product']->category . '/' . $item['product']->image, [
                                    'alt' => $item['product']->name
                                ]) ?>
                            </div>
                            <div class="product-info">
                                <h3><?= Html::encode($item['product']->name) ?></h3>
                                <p>Цена: <?= number_format($item['product']->price, 2, '.', ' ') ?> ₽</p>
                                <p>Количество: <?= $item['quantity'] ?></p>
                                <p>Сумма: <?= number_format($item['sum'], 2, '.', ' ') ?> ₽</p>
                                <?= Html::a('Удалить', ['remove-from-cart', 'id' => $item['product']->id], [
                                    'class' => 'delete-btn',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот товар из корзины?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="cart-total">
                        <h3>Итого: <?= number_format($total, 2, '.', ' ') ?> ₽</h3>
                        <?= Html::a('Оформить заказ', ['order'], ['class' => 'order-btn']) ?>
                        <?= Html::a('Очистить корзину', ['clear-cart'], [
                            'class' => 'clear-btn',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите очистить корзину?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <p class="empty-cart">У вас пока нет товаров в корзине</p>
                <?= Html::a('Вернуться к покупкам', ['home'], ['class' => 'continue-shopping']) ?>
            <?php endif; ?>
        </div>
    </div>

    <style>
    .cart-items {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .cart-item {
        display: flex;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        background: white;
    }

    .product-image img {
        max-width: 150px;
        height: auto;
        margin-right: 20px;
    }

    .product-info {
        flex-grow: 1;
    }

    .product-info h3 {
        margin: 0 0 10px 0;
        color: #333;
    }

    .price, .quantity, .sum {
        margin: 5px 0;
        color: #666;
    }

    .delete-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #c82333;
        text-decoration: none;
        color: white;
    }

    .cart-total {
        text-align: right;
        margin-top: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .order-btn, .clear-btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 4px;
        text-decoration: none;
    }

    .order-btn {
        background-color: #28a745;
        color: white;
    }

    .clear-btn {
        background-color: #ffc107;
        color: #000;
    }

    .empty-cart {
        text-align: center;
        color: #666;
        margin: 30px 0;
    }

    .continue-shopping {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 15px;
    }

    .home-link {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .home-link:hover {
        background-color: #0056b3;
        text-decoration: none;
        color: white;
    }
    </style>
</body>
</html>
