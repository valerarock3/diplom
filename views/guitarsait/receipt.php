<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $receipt app\models\Receipt */

$this->title = 'Чек заказа #' . $receipt->order_id;
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Заказ успешно оплачен</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    </div>

                    <div class="receipt-details">
                        <div class="row mb-3">
                            <div class="col-6">Номер заказа:</div>
                            <div class="col-6 text-end"><strong><?= Html::encode($receipt->order_id) ?></strong></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">Дата и время:</div>
                            <div class="col-6 text-end"><?= Html::encode($receipt->getFormattedDateTime()) ?></div>
                        </div>

                        <hr>

                        <h5 class="mb-3">Товары:</h5>
                        <?php foreach ($receipt->items as $item): ?>
                            <div class="row mb-2">
                                <div class="col-6"><?= Html::encode($item->product_name) ?></div>
                                <div class="col-3 text-end"><?= $item->quantity ?> шт.</div>
                                <div class="col-3 text-end"><?= number_format($item->total, 2, ',', ' ') ?> ₽</div>
                            </div>
                        <?php endforeach; ?>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-6">Итого:</div>
                            <div class="col-6 text-end"><strong><?= $receipt->getFormattedTotal() ?></strong></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">Способ оплаты:</div>
                            <div class="col-6 text-end">Карта <?= Html::encode($receipt->getMaskedCardNumber()) ?></div>
                        </div>

                        <div class="row">
                            <div class="col-6">Статус:</div>
                            <div class="col-6 text-end text-success"><strong><?= Html::encode($receipt->status) ?></strong></div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <?= Html::a('Вернуться на главную', ['home'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 