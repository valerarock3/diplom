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
        <?= Html::a('← Вернуться в магазин', ['guitarsait/home'], ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
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
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($product->name) ?></h5>
                            <?php if (isset($product->description) && !empty($product->description)): ?>
                                <p class="card-text"><?= Html::encode($product->description) ?></p>
                            <?php endif; ?>
                            <p class="card-text">
                                <span class="fs-5 fw-bold text-primary">
                                    <?= number_format($product->price, 0, '.', ' ') ?> ₽
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex gap-2">
                                <?= Html::a('Подробнее', ['guitarsait/view', 'id' => $product->id], [
                                    'class' => 'btn btn-outline-primary flex-grow-1'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-shopping-cart"></i> В корзину', ['guitarsait/add-to-cart', 'id' => $product->id], [
                                    'class' => 'btn btn-success flex-grow-1',
                                    'data-method' => 'post'
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
?>