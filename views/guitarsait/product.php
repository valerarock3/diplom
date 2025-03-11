<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $models app\models\Product[] */

$this->title = 'Товары';
?>

<div class="products-grid">
    <?php foreach ($models as $model): ?>
        <div class="product-item">
            <h2><?= Html::encode($model->name) ?></h2>
            
            <div class="product-image">
                <?php if ($model->image): ?>
                    <?= Html::img('@web/uploads/' . $model->image, [
                        'alt' => $model->name,
                        'class' => 'product-image'
                    ]) ?>
                <?php endif; ?>
            </div>

            <div class="product-info">
                <div class="price">
                    Цена: <?= number_format($model->price, 2, '.', ' ') ?> ₽
                </div>
                <div class="category">
                    Категория: <?= Html::encode($model->category) ?>
                </div>
                <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>