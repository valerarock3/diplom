<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products array */
/* @var $categoryName string */

$categoryTitles = [
    'guitars' => 'Гитары',
    'strings' => 'Струны',
    'accessories' => 'Аксессуары',
    'cases' => 'Чехлы и кейсы',
    'pedals' => 'Педали эффектов',
    'amplifiers' => 'Усилители'
];

$this->title = isset($categoryTitles[$categoryName]) ? $categoryTitles[$categoryName] : ucfirst($categoryName);
?>

<div class="container mt-4">
    <!-- Навигация -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['guitarsait/home']) ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('← Вернуться в магазин', ['guitarsait/home'], ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Добавляем блок фильтрации -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="min-price" class="form-label">Минимальная цена</label>
                    <input type="number" class="form-control" id="min-price" min="0" step="100">
                </div>
                <div class="col-md-4">
                    <label for="max-price" class="form-label">Максимальная цена</label>
                    <input type="number" class="form-control" id="max-price" min="0" step="100">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100 btn-filter">
                        <i class="fas fa-filter"></i> Фильтровать
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="products-container">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if ($product->image): ?>
                            <img src="<?= Url::to('@web/uploads/' . $product->image) ?>" 
                                 class="card-img-top"
                                 alt="<?= Html::encode($product->name) ?>"
                                 style="height: 200px; object-fit: contain; padding: 1rem;">
                        <?php else: ?>
                            <img src="<?= Url::to('@web/images/no-image.jpg') ?>" 
                                 class="card-img-top"
                                 alt="Изображение отсутствует"
                                 style="height: 200px; object-fit: contain; padding: 1rem;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="min-height: 48px;"><?= Html::encode($product->name) ?></h5>
                            <?php if (isset($product->description) && !empty($product->description)): ?>
                                <p class="card-text" style="min-height: 48px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    <?= Html::encode($product->description) ?>
                                </p>
                            <?php else: ?>
                                <p class="card-text" style="min-height: 48px;"></p>
                            <?php endif; ?>
                            <p class="card-text mb-4">
                                <span class="fs-5 fw-bold text-primary">
                                    <?= number_format($product->price, 0, '.', ' ') ?> ₽
                                </span>
                            </p>
                            <div class="mt-auto d-grid gap-2">
                                <?= Html::a('Подробнее', ['guitarsait/view', 'id' => $product->id], [
                                    'class' => 'btn btn-primary'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-shopping-cart"></i> В корзину', 'javascript:void(0);', [
                                    'class' => 'btn btn-success cart-add-btn',
                                    'data-id' => $product->id,
                                    'onclick' => "addToCart('" . Url::to(['guitarsait/add-to-cart', 'id' => $product->id]) . "')"
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h4 class="alert-heading">Товары не найдены</h4>
            <p>В данной категории пока нет товаров. Пожалуйста, загляните позже или выберите другую категорию.</p>
            <?= Html::a('Вернуться к категориям', ['guitarsait/home'], ['class' => 'btn btn-primary mt-3']) ?>
        </div>
    <?php endif; ?>
</div>

<?php
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
// Добавляем подключение jQuery
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJs("
    $(document).ready(function() {
        $('.btn-filter').on('click', function() {
            const minPrice = parseFloat($('#min-price').val()) || 0;
            const maxPrice = parseFloat($('#max-price').val()) || Infinity;
            
            $('.col').each(function() {
                const priceText = $(this).find('.text-primary').text();
                const price = parseFloat(priceText.replace(/[^0-9]/g, ''));
                
                if (price >= minPrice && (maxPrice === Infinity || price <= maxPrice)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            
            if ($('.col:visible').length === 0) {
                if ($('#no-results-message').length === 0) {
                    $('#products-container').after(
                        '<div id=\"no-results-message\" class=\"alert alert-info mt-3\">' +
                        'По вашему запросу ничего не найдено. Попробуйте изменить параметры фильтра.' +
                        '</div>'
                    );
                }
            } else {
                $('#no-results-message').remove();
            }
        });
    });
");
?>