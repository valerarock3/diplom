<?php








?>
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

        <a href="reviews.html">Отзывы</a>
        <a href="kozina.html">Корзина</a>
    </div>
    <!-- реклама -->
    <div class="advertising"></div>
<!-- контейнер с икнонками разделов товаров -->
<div class="block-with-goods">
    <!-- контент с гитарами --> 
    <div class="guitar-content">
        <img src="гитара.jpg" alt="гитары">
        <a href="sait_towar">гитары</a>
    </div>
    <!-- контент струны для гитары -->
    <div class="guitar-strings-content">
        <img src="струны.jpg" alt="струны для гитары">
        <a href="sait_towar">струны для гитары</a>
    </div>
    <!-- контент гитарные усилители -->
    <div class="guitar-amplifiers-content">
        <img src="гитарный усилитель.jpg" alt="гитарные усилители">
        <a href="sait_towar">гитарные усилители</a>
    </div>
    <!-- контент с педалями усиления звука -->
    <div class="pedals-and-effects-processors-content">
        <img src="педаль.jpg" alt="педали усиления звука">
        <a href="sait_towar">педали усиления звука</a>
    </div>
    <!-- Чехлы и кейсы для гитар -->
    <div class="cases-and-covers-for-guitars-content">
        <img src="чехлы.jpg" alt="Чехлы и кейсы для гитар">
        <a href="sait_towar">Чехлы и кейсы для гитар</a>
    </div>
    <!-- Аксессуары для гитар -->
    <div class="guitar-accessories-content">
        <img src="аксессуары.jpg" alt="Аксессуары для гитар">
        <a href="sait_towar">Аксессуары для гитар</a>
    </div>
    <!-- контактное поле -->
    <div class="contacts-content"></div>
   </div>
</body>
</html>