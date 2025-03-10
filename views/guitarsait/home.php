<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\GuitarAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

GuitarAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашняя страница</title>
    <link rel="stylesheet" href="poisk.css">
    <link rel="stylesheet" href="sait.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="site-content">
        <!-- Поисковая строка и корзина -->
        <div class="top-bar">
            <div class="search-bar">
                <?= Html::textInput('search', '', ['class' => 'search-input', 'placeholder' => 'Введите название товара']) ?>
                <?= Html::button('Искать', ['class' => 'search-button']) ?>
            </div>
            <div class="nav-links">
                <?= Html::a('Отзывы', ['reviews'], ['class' => 'nav-link']) ?>
                <?= Html::a('Корзина', ['korzina'], ['class' => 'nav-link']) ?>
            </div>
        </div>

        <!-- Сетка категорий -->
        <div class="categories-grid">
            <?php foreach ($categories as $key => $category): ?>
                <div class="category-item">
                    <?= Html::a(
                        Html::img('@web/images/' . $category['image'], [
                            'alt' => $category['title'],
                            'class' => 'category-image'
                        ]) . 
                        Html::encode($category['title']),
                        $category['url'],
                        ['class' => 'category-link']
                    ) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Контакты -->
        <div class="contacts">
            <h2>Контакты</h2>
            <p>Телефон: +7 (999) 999-99-99</p>
            <p>Email: info@example.com</p>
            <p>Адрес: ул. Пушкина, д. 10</p>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>

<?php
$this->registerCss("
    .site-content {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        gap: 10px;
    }

    .search-input {
        padding: 8px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-button {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #0056b3;
    }

    .nav-links {
        display: flex;
        gap: 20px;
    }

    .nav-link {
        text-decoration: none;
        color: #333;
        padding: 8px 16px;
        border-radius: 4px;
    }

    .nav-link:hover {
        background-color: #f8f9fa;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .category-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background-color: white;
    }
    
    .category-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .category-link {
        display: block;
        text-decoration: none;
        color: #333;
        text-align: center;
    }
    
    .category-image {
        width: 100%;
        height: auto;
        display: block;
    }

    .contacts {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .contacts h2 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
    }

    .contacts p {
        margin: 5px 0;
        color: #666;
    }
");
?>