<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\GuitarAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
use app\assets\AppAsset;

GuitarAsset::register($this);
AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// Регистрируем CSS и JavaScript файлы для уведомлений
$this->registerCssFile('@web/css/notifications.css');
$this->registerJsFile('@web/js/notifications.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Проверяем наличие флеш-сообщений и показываем их
$flashMessages = Yii::$app->session->getAllFlashes();
if (!empty($flashMessages)) {
    $script = '';
    foreach ($flashMessages as $type => $message) {
        $script .= "showNotification(" . json_encode($message) . ", '$type');\n";
    }
    $this->registerJs($script);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            max-width: 350px;
            background-color: #fff;
            color: #333;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            overflow: hidden;
            z-index: 9999;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .toast-notification.show {
            opacity: 1;
            transform: translateX(0);
        }
        .toast-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background-color: #28a745;
            color: white;
        }
        .toast-header.error {
            background-color: #dc3545;
        }
        .toast-notification .icon {
            margin-right: 10px;
            font-size: 20px;
        }
        .toast-notification .close-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .toast-notification .close-btn:hover {
            opacity: 1;
        }
        .toast-body {
            padding: 15px;
            line-height: 1.5;
        }
        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background-color: rgba(255,255,255,0.3);
        }
        .progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: #28a745;
            transform: scaleX(0);
            transform-origin: left;
            animation: progress 3s linear forwards;
        }
        .toast-header.error .progress-bar::before {
            background-color: #dc3545;
        }
        @keyframes progress {
            to {
                transform: scaleX(1);
            }
        }
        .navbar-nav {
            flex-grow: 1;
        }
        .navbar-nav .nav-item {
            margin-right: 15px;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-form .form-control {
            border-radius: 4px 0 0 4px;
        }
        .search-form .btn {
            border-radius: 0 4px 4px 0;
        }
        .header-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-counter {
            margin-left: 5px;
            font-size: 0.8em;
            padding: 0.25em 0.6em;
            border-radius: 10px;
            position: relative;
            top: -1px;
            display: inline-block;
        }
        .badge {
            margin-left: 5px;
            font-size: 0.8em;
            padding: 0.25em 0.6em;
            border-radius: 10px;
            position: relative;
            top: -1px;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Music Store',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto'],
        'items' => [
            ['label' => 'Home', 'url' => ['/guitarsait/home']],
            ['label' => '<i class="fas fa-plus"></i> Добавить товар', 'url' => ['/guitarsait/create'], 'encode' => false],
        ],
    ]);
    ?>
    <div class="d-flex align-items-center gap-2">
        <form method="get" class="d-flex align-items-center">
            <div class="input-group">
                <input type="hidden" name="r" value="guitarsait/search">
                <input type="text" name="query" class="form-control" placeholder="Поиск товаров..." style="height: 38px; border-radius: 4px 0 0 4px;">
                <button class="btn btn-primary d-flex align-items-center justify-content-center" type="submit" style="height: 38px; width: 38px; border-radius: 0 4px 4px 0; padding: 0;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <?= Html::a(
            '<i class="fas fa-star"></i> Новинка',
            ['/guitarsait/new'],
            ['class' => 'btn btn-outline-warning d-flex align-items-center', 'style' => 'height: 38px;']
        ) ?>
        <a href="<?= Url::to(['/guitarsait/korzina']) ?>" class="btn btn-outline-light d-flex align-items-center" style="height: 38px;">
            <i class="fas fa-shopping-cart"></i>
            <span style="margin-left: 5px;">Корзина</span>
            <?php
            $cartItems = Yii::$app->session->get('cart', []);
            $totalCount = 0;
            foreach ($cartItems as $item) {
                if (isset($item['quantity'])) {
                    $totalCount += (int)$item['quantity'];
                } else {
                    $totalCount += 1;
                }
            }
            if ($totalCount > 0): ?>
                <span class="badge bg-danger rounded-pill ms-1"><?= $totalCount ?></span>
            <?php endif; ?>
        </a>
    </div>
    <?php NavBar::end(); ?>
</header>

<?php
$cartCountUrl = Url::to(['/guitarsait/get-cart-count']);
$js = <<<JS
    function updateCartCounter() {
        fetch('{$cartCountUrl}', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const cartLink = document.querySelector('a[href*="guitarsait/korzina"]');
            if (cartLink) {
                let badge = cartLink.querySelector('.badge');
                if (data.count > 0) {
                    if (!badge) {
                        badge = document.createElement('span');
                        badge.className = 'badge bg-danger rounded-pill ms-1';
                        cartLink.appendChild(badge);
                    }
                    badge.textContent = data.count;
                } else if (badge) {
                    badge.remove();
                }
            }
        })
        .catch(error => console.error('Ошибка при обновлении счетчика:', error));
    }

    // Обновляем счетчик при загрузке страницы
    document.addEventListener('DOMContentLoaded', updateCartCounter);
    
    // Обновляем счетчик после любых изменений в корзине
    document.addEventListener('click', function(e) {
        const target = e.target;
        if (target.closest('.add-to-cart') || 
            target.closest('.remove-from-cart') || 
            target.closest('.clear-cart') ||
            target.closest('[data-action="increase-quantity"]') ||
            target.closest('[data-action="decrease-quantity"]')) {
            setTimeout(updateCartCounter, 100);
        }
    });

    // Периодическое обновление счетчика
    setInterval(updateCartCounter, 1000);
JS;
$this->registerJs($js);
?>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php 
        // Получаем все флеш-сообщения
        $flashes = Yii::$app->session->getAllFlashes();
        if (!empty($flashes)) {
            $this->registerJs("
                document.addEventListener('DOMContentLoaded', function() {
                    " . implode("\n", array_map(function($type, $message) {
                        // Конвертируем типы флеш-сообщений в типы наших уведомлений
                        $notificationType = $type === 'success' ? 'success' : ($type === 'error' ? 'error' : 'success');
                        if (is_array($message)) {
                            $message = implode(', ', $message);
                        }
                        return "showNotification(" . json_encode($message) . ", '$notificationType');";
                    }, array_keys($flashes), array_values($flashes))) . "
                });
            ");
        }
        ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; My Company <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>
// Функция для показа красивого уведомления
function showNotification(message, type) {
    // Удаляем старые уведомления, если они есть
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Создаем уведомление
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    
    const isError = type === 'error';
    const icon = isError ? 'exclamation-circle' : 'check-circle';
    const title = isError ? 'Ошибка' : 'Успешно';
    
    // HTML-структура уведомления
    toast.innerHTML = `
        <div class="toast-header ${isError ? 'error' : ''}">
            <span class="icon"><i class="fas fa-${icon}"></i></span>
            <span class="title">${title}</span>
            <button class="close-btn">&times;</button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
        <div class="progress-bar"></div>
    `;
    
    // Добавляем в DOM
    document.body.appendChild(toast);
    
    // Запускаем анимацию появления
    setTimeout(() => {
        toast.classList.add('show');
    }, 10);
    
    // Обработчик кнопки закрытия
    const closeBtn = toast.querySelector('.close-btn');
    closeBtn.addEventListener('click', () => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 400);
    });
    
    // Автоматическое закрытие через 3 секунды
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 400);
    }, 3000);
}

// Функция для добавления товара в корзину через AJAX
function addToCart(url) {
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': '<?= Yii::$app->request->getCsrfToken() ?>',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        showNotification(data.success ? 'Товар успешно добавлен в корзину' : data.message, data.success ? 'success' : 'error');
        if (data.success) {
            // Обновляем счетчик корзины
            updateCartCounter();
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        showNotification('Произошла ошибка при добавлении товара', 'error');
    });
    
    return false; // Предотвращаем стандартное действие ссылки
}

// Функция для обновления счетчика корзины через AJAX
function updateCartCounter() {
    fetch('<?= Url::to(['/guitarsait/get-cart-count']) ?>', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.count !== undefined) {
            const counterElement = document.querySelector('.cart-counter');
            if (counterElement) {
                counterElement.textContent = data.count;
            }
        }
    })
    .catch(error => {
        console.error('Ошибка при обновлении счетчика корзины:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Обработчик для кнопок с классом add-to-cart-btn, которые являются частью формы
    document.body.addEventListener('click', function(e) {
        const button = e.target.closest('button.add-to-cart-btn');
        if (button) {
            const productId = button.getAttribute('data-id');
            if (productId) {
                e.preventDefault();
                addToCart('<?= Url::to(['guitarsait/add-to-cart']) ?>?id=' + productId);
            }
        }
    });
});
</script>
</body>
</html>
<?php $this->endPage() ?>
