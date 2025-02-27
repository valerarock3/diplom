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
   <div class="sait">
    <!-- лого -->
    <div class="header">
        <!-- поле ввода поиска товаров -->
        <form action="/search" method="get">
            <input type="text" name="query" placeholder="Введите название товара">
            <button type="submit">Искать</button>
        </form>

        <a href="reviews">Отзывы</a>
        <a href="korzina">Корзина</a>
    </div>
    <!-- реклама -->
    <div class="advertising"></div>
<!-- контейнер с икнонками разделов товаров -->
<div class="block-with-goods">
    <!-- контент с гитарами --> 
    <div class="guitar-content">
        <img src="гитара.jpg" alt="гитары">
        <a href="product">гитары</a>
    </div>
    <!-- контент струны для гитары -->
    <div class="guitar-strings-content">
        <img src="струны.jpg" alt="струны для гитары">
        <a href="product">струны для гитары</a>
    </div>
    <!-- контент гитарные усилители -->
    <div class="guitar-amplifiers-content">
        <img src="гитарный усилитель.jpg" alt="гитарные усилители">
        <a href="product">гитарные усилители</a>
    </div>
    <!-- контент с педалями усиления звука -->
    <div class="pedals-and-effects-processors-content">
        <img src="педаль.jpg" alt="педали усиления звука">
        <a href="product">педали усиления звука</a>
    </div>
    <!-- Чехлы и кейсы для гитар -->
    <div class="cases-and-covers-for-guitars-content">
        <img src="чехлы.jpg" alt="Чехлы и кейсы для гитар">
        <a href="product">Чехлы и кейсы для гитар</a>
    </div>
    <!-- Аксессуары для гитар -->
    <div class="guitar-accessories-content">
        <img src="аксессуары.jpg" alt="Аксессуары для гитар">
        <a href="product">Аксессуары для гитар</a>
    </div>
    <!-- контактное поле -->
    <div class="contacts-content"></div>
   </div>
</body>
</html>