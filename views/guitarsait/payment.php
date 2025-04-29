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

                    <form id="payment-form" method="post" action="<?= Url::to(['guitarsait/process-payment']) ?>">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                        
                        <!-- Поле для номера карты -->
                        <div class="form-group mb-3">
                            <label for="card-number">Номер карты</label>
                            <input type="text" name="cardNumber" class="form-control card-number-input" id="card-number" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required>
                            <div class="invalid-feedback">Пожалуйста, введите корректный номер карты</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exp-date">Срок действия</label>
                                    <input type="text" name="expDate" class="form-control exp-date-input" id="exp-date" maxlength="5" placeholder="MM/YY" required>
                                    <div class="invalid-feedback">Введите корректный срок действия</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cvv">CVV код</label>
                                    <input type="password" name="cvv" class="form-control cvv-input" id="cvv" maxlength="3" placeholder="XXX" required>
                                    <div class="invalid-feedback">Введите CVV код</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="card-holder">Держатель карты</label>
                            <input type="text" name="cardHolder" class="form-control cardholder-input" id="card-holder" placeholder="ИМЯ ФАМИЛИЯ" required>
                            <div class="invalid-feedback">Введите имя держателя карты</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg" id="submit-payment">Оплатить</button>
                            <?= Html::a('Отмена', ['korzina'], ['class' => 'btn btn-secondary btn-lg']) ?>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <?php if (file_exists(Yii::getAlias('@webroot/images/visa.png'))): ?>
                            <img src="<?= Url::to('@web/images/visa.png') ?>" 
                                 alt="Visa" 
                                 class="me-3" 
                                 style="height: 30px; object-fit: contain;">
                        <?php else: ?>
                            <div class="d-inline-block me-3 text-center" style="width: 50px; height: 30px;">
                                <i class="fab fa-cc-visa fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (file_exists(Yii::getAlias('@webroot/images/mastercard.png'))): ?>
                            <img src="<?= Url::to('@web/images/mastercard.png') ?>" 
                                 alt="MasterCard" 
                                 style="height: 30px; object-fit: contain;">
                        <?php else: ?>
                            <div class="d-inline-block text-center" style="width: 50px; height: 30px;">
                                <i class="fab fa-cc-mastercard fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    // Форматирование номера карты
    $('.card-number-input').on('input', function(e) {
        let value = $(this).val().replace(/\D/g, '');
        
        if (value.length > 16) {
            value = value.substring(0, 16);
        }
        
        // Форматируем номер карты (XXXX XXXX XXXX XXXX)
        let formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ').trim();
        $(this).val(formattedValue);
    });

    // Форматирование срока действия
    $('.exp-date-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 4) {
            value = value.substring(0, 4);
        }
        
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2);
        }
        
        $(this).val(value);
    });

    // Форматирование CVV
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

    // Валидация формы перед отправкой
    $('#payment-form').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        
        // Проверка номера карты
        const cardNumber = $('.card-number-input').val().replace(/\s/g, '');
        if (cardNumber.length !== 16) {
            $('.card-number-input').addClass('is-invalid');
            isValid = false;
        } else {
            $('.card-number-input').removeClass('is-invalid');
        }
        
        // Проверка срока действия
        const expDate = $('.exp-date-input').val();
        if (!/^\d{2}\/\d{2}$/.test(expDate)) {
            $('.exp-date-input').addClass('is-invalid');
            isValid = false;
        } else {
            $('.exp-date-input').removeClass('is-invalid');
        }
        
        // Проверка CVV
        const cvv = $('.cvv-input').val();
        if (cvv.length !== 3) {
            $('.cvv-input').addClass('is-invalid');
            isValid = false;
        } else {
            $('.cvv-input').removeClass('is-invalid');
        }
        
        // Проверка держателя карты
        const cardHolder = $('.cardholder-input').val().trim();
        if (cardHolder.length < 3) {
            $('.cardholder-input').addClass('is-invalid');
            isValid = false;
        } else {
            $('.cardholder-input').removeClass('is-invalid');
        }
        
        if (isValid) {
            this.submit();
        }
    });
});
JS;
$this->registerJs($js);
?>

<!-- Убедимся, что jQuery подключен -->
<?php
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', [
    'position' => \yii\web\View::POS_HEAD
]);
?> 