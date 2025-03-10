<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ProductForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Product;
use app\models\Cart;

class GuitarsaitController extends Controller{


    //  домашняя страница
    public function actionHome()
    {
        // Определяем категории и их параметры
        $categories = [
            'guitars' => [
                'title' => 'Гитары',
                'image' => 'guitars.jpg',
                'url' => ['guitarsait/category', 'category' => 'guitars']
            ],
            'strings' => [
                'title' => 'Струны для гитары',
                'image' => 'strings.jpg',
                'url' => ['guitarsait/category', 'category' => 'strings']
            ],
            'amplifiers' => [
                'title' => 'Гитарные усилители',
                'image' => 'amplifiers.jpg',
                'url' => ['guitarsait/category', 'category' => 'amplifiers']
            ],
            'pedals' => [
                'title' => 'Педали усиления звука',
                'image' => 'pedals.jpg',
                'url' => ['guitarsait/category', 'category' => 'pedals']
            ],
            'cases' => [
                'title' => 'Чехлы и кейсы для гитар',
                'image' => 'cases.jpg',
                'url' => ['guitarsait/category', 'category' => 'cases']
            ],
            'accessories' => [
                'title' => 'Аксессуары для гитар',
                'image' => 'accessories.jpg',
                'url' => ['guitarsait/category', 'category' => 'accessories']
            ],
        ];

        return $this->render('home', [
            'categories' => $categories
        ]);
    }

    public function actionCategory($category)
    {
        // Проверяем существование категории
        $categoryData = $this->getCategoryData($category);
        if (!$categoryData) {
            throw new NotFoundHttpException('Категория не найдена.');
        }

        // Получаем товары для выбранной категории
        $products = $this->getProductsByCategory($category);

        return $this->render('category', [
            'categoryData' => $categoryData,
            'products' => $products
        ]);
    }

    private function getCategoryData($category)
    {
        $categories = [
            'guitars' => [
                'title' => 'Гитары',
                'description' => 'Электрогитары и акустические гитары'
            ],
            'strings' => [
                'title' => 'Струны для гитары',
                'description' => 'Струны различных калибров и производителей'
            ],
            'amplifiers' => [
                'title' => 'Гитарные усилители',
                'description' => 'Комбоусилители и усилители для гитар'
            ],
            'pedals' => [
                'title' => 'Педали усиления звука',
                'description' => 'Педали эффектов для гитар'
            ],
            'cases' => [
                'title' => 'Чехлы и кейсы для гитар',
                'description' => 'Защитные чехлы и кейсы для хранения и транспортировки'
            ],
            'accessories' => [
                'title' => 'Аксессуары для гитар',
                'description' => 'Различные аксессуары для гитар'
            ],
        ];

        return isset($categories[$category]) ? $categories[$category] : null;
    }

    private function getProductsByCategory($category)
    {
        // Здесь можно добавить маппинг категорий к конкретным условиям поиска
        $conditions = [
            'guitars' => ['category' => 'guitars'],
            'strings' => ['category' => 'strings'],
            'amplifiers' => ['category' => 'amplifiers'],
            'pedals' => ['category' => 'pedals'],
            'cases' => ['category' => 'cases'],
            'accessories' => ['category' => 'accessories'],
        ];

        if (!isset($conditions[$category])) {
            return [];
        }

        return Product::find()
            ->where($conditions[$category])
            ->all();
    }

    // корзина
    public function actionKorzina()
    {
        $cartItems = Cart::getCart();
        $total = Cart::getTotal();
        
        return $this->render('korzina', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
    // отзывы
    public function actionReviews()
    {
        return $this->render('reviews');
    }
    // вызов страницы с товарами
    public function actionView($id)
    {
        $model = Product::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Товар не найден.');
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionProduct($category = null)
    {
        if ($category) {
            // Получаем товары по категории
            $models = Product::find()
                ->where(['category' => $category])
                ->all();
        } else {
            // Получаем все товары
            $models = Product::find()->all();
        }
        
        if (empty($models)) {
            throw new NotFoundHttpException('Товары не найдены.');
        }

        return $this->render('product', [
            'models' => $models
        ]);
    }

    // Добавить поиск товаров
    public function actionSearch($query = '')
    {
        $products = ProductForm::find()
            ->where(['like', 'name', $query])
            ->all();
            
        return $this->render('search', [
            'products' => $products,
            'query' => $query
        ]);
    }

    public function actionAddToCart($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            Cart::addToCart($id);
            Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClearCart()
    {
        Cart::clearCart();
        Yii::$app->session->setFlash('success', 'Корзина очищена');
        return $this->redirect(['home']); // Перенаправление на главную страницу
    }

    public function actionRemoveFromCart($id)
    {
        Cart::removeFromCart($id);
        Yii::$app->session->setFlash('success', 'Товар удален из корзины');
        return $this->redirect(['korzina']);
    }

}