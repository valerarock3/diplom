<?php
use yii\helpers\Html;

/* @var $categoryData array */
/* @var $products array */
?>

<div class="category-page">
    <!-- Кнопка возврата на главную -->
    <div class="back-button">
        <?= Html::a('Вернуться на главную', ['home'], ['class' => 'btn-back']) ?>
    </div>

    <h1><?= Html::encode($categoryData['title']) ?></h1>
    <p class="category-description"><?= Html::encode($categoryData['description']) ?></p>

    <?php if (!empty($products)): ?>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <?php if ($product->image): ?>
                        <div class="product-image">
                            <?= Html::img('@web/images/products/' . $product->category . '/' . $product->image, [
                                'alt' => $product->name
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-info">
                        <h2><?= Html::encode($product->name) ?></h2>
                        <div class="price">
                            Цена: <?= number_format($product->price, 2, '.', ' ') ?> ₽
                        </div>
                        <div class="product-actions">
                            <?= Html::a('Добавить в корзину', ['add-to-cart', 'id' => $product->id], [
                                'class' => 'btn-add-to-cart',
                                'data-method' => 'post'
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>В данной категории товары отсутствуют.</p>
    <?php endif; ?>
</div> 