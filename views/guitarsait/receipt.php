<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $orderNumber string */
/* @var $cardNumber string */
/* @var $cardHolder string */
/* @var $total float */
/* @var $items array */
/* @var $date string */

$this->title = 'Чек об оплате';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center mb-0">Чек об оплате</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5 class="text-success">Оплата прошла успешно!</h5>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <strong>Номер заказа:</strong><br>
                            <?= Html::encode($orderNumber) ?>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <strong>Дата:</strong><br>
                            <?= Html::encode($date) ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <strong>Оплачено картой:</strong><br>
                        **** **** **** <?= Html::encode($cardNumber) ?><br>
                        <?= Html::encode($cardHolder) ?>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Товар</th>
                                    <th class="text-center">Количество</th>
                                    <th class="text-end">Цена</th>
                                    <th class="text-end">Сумма</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= Html::encode($item['name']) ?></td>
                                    <td class="text-center"><?= Html::encode($item['quantity']) ?></td>
                                    <td class="text-end"><?= number_format($item['price'], 2, ',', ' ') ?> ₽</td>
                                    <td class="text-end"><?= number_format($item['price'] * $item['quantity'], 2, ',', ' ') ?> ₽</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Итого:</th>
                                    <th class="text-end"><?= number_format($total, 2, ',', ' ') ?> ₽</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <p class="mb-4">Спасибо за покупку!</p>

                        <div class="d-flex justify-content-center" style="gap: 10px;">
                            <?= Html::a('Вернуться на главную', ['home'], ['class' => 'btn btn-primary', 'style' => 'width: 200px;']) ?>
                            <?= Html::a('Распечатать чек', '#', [
                                'class' => 'btn btn-secondary',
                                'style' => 'width: 200px;',
                                'onclick' => 'window.print(); return false;'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 