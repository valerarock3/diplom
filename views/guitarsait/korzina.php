<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $cartItems array */
/* @var $total float */

$this->title = 'Корзина';
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['home']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Корзина</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Корзина</h1>
        <?= Html::a('← Вернуться в магазин', ['home'], [
            'class' => 'btn btn-primary'
        ]) ?>
    </div>

    <?php if (!empty($cartItems)): ?>
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($cartItems as $item): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <?php if ($item['image']): ?>
                                    <img src="<?= Url::to('@web/uploads/' . $item['image']) ?>"
                                         class="img-fluid rounded-start"
                                         alt="<?= Html::encode($item['name']) ?>"
                                         style="max-height: 200px; object-fit: cover;">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Html::encode($item['name']) ?></h5>
                                    <p class="card-text">
                                        <strong>Цена:</strong> <?= number_format($item['price'], 0, '.', ' ') ?> ₽<br>
                                        <strong>Количество:</strong> <?= $item['quantity'] ?><br>
                                        <strong>Сумма:</strong> <?= number_format($item['total'], 0, '.', ' ') ?> ₽
                                    </p>
                                    <?= Html::a('Удалить', ['remove-from-cart', 'id' => $item['id']], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'method' => 'post',
                                            'confirm' => 'Вы уверены, что хотите удалить этот товар из корзины?'
                                        ]
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Итого</h5>
                        <p class="card-text">
                            <strong>Общая сумма:</strong><br>
                            <span class="h3"><?= number_format($total, 0, '.', ' ') ?> ₽</span>
                        </p>
                        <?= Html::a('Оформить заказ', ['checkout'], [
                            'class' => 'btn btn-success btn-lg w-100 mb-2'
                        ]) ?>
                        <?= Html::a('Очистить корзину', ['clear-cart'], [
                            'class' => 'btn btn-outline-danger w-100',
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'Вы уверены, что хотите очистить корзину?'
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h4 class="alert-heading">Ваша корзина пуста</h4>
            <p>Добавьте товары в корзину, чтобы оформить заказ.</p>
            <?= Html::a('Перейти к покупкам', ['home'], ['class' => 'btn btn-primary mt-3']) ?>
        </div>
    <?php endif; ?>
</div>
