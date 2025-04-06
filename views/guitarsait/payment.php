<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\PaymentForm;

/* @var $this yii\web\View */
/* @var $model PaymentForm */
/* @var $total float */

$this->title = 'Оплата заказа';
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['index']) ?></li>
            <li class="breadcrumb-item"><?= Html::a('Корзина', ['korzina']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Оплата</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Оплата заказа</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Сумма к оплате: <?= number_format($total, 2, ',', ' ') ?> ₽</h5>
                    </div>

                    <?php $form = ActiveForm::begin([
                        'id' => 'payment-form',
                        'enableClientValidation' => true,
                        'enableAjaxValidation' => false,
                    ]); ?>

                    <?= $form->field($model, 'cardNumber')
                        ->textInput([
                            'maxlength' => 19,
                            'placeholder' => 'XXXX XXXX XXXX XXXX',
                            'class' => 'form-control card-number-input'
                        ]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'expDate')
                                ->textInput([
                                    'maxlength' => 5,
                                    'placeholder' => 'MM/YY',
                                    'class' => 'form-control exp-date-input'
                                ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'cvv')
                                ->passwordInput([
                                    'maxlength' => 3,
                                    'placeholder' => 'XXX',
                                    'class' => 'form-control cvv-input'
                                ]) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'cardHolder')
                        ->textInput([
                            'placeholder' => 'ИМЯ ФАМИЛИЯ',
                            'class' => 'form-control cardholder-input'
                        ]) ?>

                    <div class="d-grid gap-2">
                        <?= Html::submitButton('Оплатить', [
                            'class' => 'btn btn-success btn-lg',
                            'id' => 'submit-payment'
                        ]) ?>
                        <?= Html::a('Отмена', ['korzina'], [
                            'class' => 'btn btn-outline-secondary'
                        ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="mt-3 text-center">
                        <img src="<?= Url::to('@web/images/visa.png') ?>" alt="Visa" class="me-2" style="height: 30px;">
                        <img src="<?= Url::to('@web/images/mastercard.png') ?>" alt="MasterCard" style="height: 30px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
    // Форматирование номера карты
    $('.card-number-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 16) {
            value = value.substring(0, 16);
        }
        value = value.replace(/(\d{4})/g, '$1 ').trim();
        $(this).val(value);
    });

    // Форматирование срока действия
    $('.exp-date-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 4) {
            value = value.substring(0, 4);
        }
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2);
        }
        $(this).val(value);
    });

    // Ограничение CVV тремя цифрами
    $('.cvv-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 3) {
            value = value.substring(0, 3);
        }
        $(this).val(value);
    });

    // Форматирование имени держателя карты
    $('.cardholder-input').on('input', function() {
        let value = $(this).val().toUpperCase();
        $(this).val(value);
    });
JS;
$this->registerJs($js);
?> 