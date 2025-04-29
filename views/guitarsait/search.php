<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products array */
/* @var $query string */

$this->title = 'Поиск товаров';
?>

<div class="container mt-4">
    <!-- Навигация -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['guitarsait/home']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Поиск товаров</li>
        </ol>
    </nav>

    <!-- Заголовок и кнопка возврата -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Результаты поиска по запросу: "<?= Html::encode($query) ?>"</h1>
        <?= Html::a('← Вернуться в магазин', ['guitarsait/home'], [
            'class' => 'btn btn-primary d-flex align-items-center',
            'style' => 'height: 38px;'
        ]) ?>
    </div>

    <!-- Форма поиска -->
    <div class="search-form mb-4">
        <form method="get" class="d-flex align-items-center">
            <div class="input-group">
                <input type="hidden" name="r" value="guitarsait/search">
                <?= Html::textInput('query', $query, [
                    'class' => 'form-control',
                    'placeholder' => 'Введите название товара...',
                    'style' => 'height: 38px; border-radius: 4px 0 0 4px;'
                ]) ?>
                <?= Html::submitButton('<i class="fas fa-search"></i>', [
                    'class' => 'btn btn-primary d-flex align-items-center justify-content-center',
                    'style' => 'height: 38px; width: 38px; border-radius: 0 4px 4px 0; padding: 0;'
                ]) ?>
            </div>
        </form>
    </div>

    <?php if (empty($products)): ?>
        <div class="alert alert-info">
            <h4 class="alert-heading">Товары не найдены</h4>
            <p>По вашему запросу "<?= Html::encode($query) ?>" ничего не найдено.</p>
            <hr>
            <p class="mb-0">Попробуйте изменить поисковый запрос или вернитесь к просмотру всех товаров.</p>
            <?= Html::a('Вернуться к категориям', ['guitarsait/home'], [
                'class' => 'btn btn-primary d-flex align-items-center justify-content-center',
                'style' => 'height: 38px; width: fit-content; margin-top: 1rem;'
            ]) ?>
        </div>
    <?php else: ?>
        <!-- Сетка товаров -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if (!empty($product->image) && file_exists(Yii::getAlias('@webroot/uploads/' . $product->image))): ?>
                            <img src="<?= Url::to('@web/uploads/' . $product->image) ?>" 
                                 class="card-img-top" 
                                 alt="<?= Html::encode($product->name) ?>"
                                 style="height: 200px; object-fit: contain; padding: 1rem;">
                        <?php else: ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center text-center"
                                 style="height: 200px; background-color: #f8f9fa; color: #6c757d; padding: 1rem;">
                                <div>
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <div>Изображение отсутствует</div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= Html::encode($product->name) ?></h5>
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
    <?php endif; ?>
</div>

<?php
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?> 