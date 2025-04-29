<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */

$this->title = 'Новинка — Набор для гитариста';

// Регистрируем JavaScript для обработки формы "Добавить все в корзину"
$this->registerJs("
    // Проверяем, доступна ли функция showNotification
    console.log('showNotification function available:', typeof showNotification === 'function');
    
    // Пробуем вызвать её напрямую
    try {
        setTimeout(() => {
            showNotification('Тестовое уведомление при загрузке страницы', 'success');
        }, 1000);
    } catch (e) {
        console.error('Error showing notification:', e);
    }
    
    document.getElementById('add-all-to-cart-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Показываем уведомление сразу после нажатия кнопки
        try {
            console.log('Showing notification before fetch');
            showNotification('Товары добавляются в корзину...', 'success');
        } catch (e) {
            console.error('Error showing notification:', e);
        }
        
        fetch(this.getAttribute('action'), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-Token': '" . Yii::$app->request->getCsrfToken() . "',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Success response, showing notification');
                // Показываем уведомление напрямую здесь, как в функции addToCart
                showNotification('Товар успешно добавлен в корзину', 'success');
                
                // Обновляем счетчик корзины
                if (typeof updateCartCounter === 'function') {
                    updateCartCounter();
                }
                
                // Задержка перед переходом в корзину
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                console.log('Error response, showing notification');
                showNotification(data.message || 'Не удалось добавить товары в корзину', 'error');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('Произошла ошибка при добавлении товаров', 'error');
        });
    });
");
?>
<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['guitarsait/home']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Новинка</li>
        </ol>
    </nav>
    <h1 class="mb-4">Набор для гитариста <span class="badge bg-warning text-dark">Новинка</span></h1>

    <!-- Кнопка добавить все в корзину -->
    <form id="add-all-to-cart-form" method="post" action="<?= Url::to(['guitarsait/add-all-to-cart']) ?>">
        <?php foreach ($products as $product): ?>
            <input type="hidden" name="ids[]" value="<?= $product->id ?>">
        <?php endforeach; ?>
        <?= Html::submitButton('<i class="fas fa-cart-plus"></i> Добавить все в корзину', [
            'class' => 'btn btn-primary mb-4',
            'style' => 'min-width:200px;'
        ]) ?>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
    </form>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <?php if ($product->image && file_exists(Yii::getAlias('@webroot/uploads/' . $product->image))): ?>
                        <img src="<?= Url::to('@web/uploads/' . $product->image) ?>" 
                             class="card-img-top" 
                             alt="<?= Html::encode($product->name) ?>" 
                             style="height: 200px; object-fit: contain; padding: 1rem;">
                    <?php else: ?>
                        <img src="<?= Url::to('@web/images/no-image.svg') ?>" 
                             class="card-img-top" 
                             alt="Изображение отсутствует" 
                             style="height: 200px; object-fit: contain; padding: 1rem;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($product->name) ?></h5>
                        <?php if (!empty($product->description)): ?>
                            <p class="card-text"><?= Html::encode($product->description) ?></p>
                        <?php endif; ?>
                        <p class="card-text">
                            <span class="fs-5 fw-bold text-primary">
                                <?= number_format($product->price, 0, '.', ' ') ?> ₽
                            </span>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <?= Html::a('<i class="fas fa-shopping-cart"></i> В корзину', 'javascript:void(0);', [
                            'class' => 'btn btn-success w-100 cart-add-btn',
                            'data-id' => $product->id,
                            'onclick' => "addToCart('" . Url::to(['guitarsait/add-to-cart', 'id' => $product->id]) . "')"
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div> 