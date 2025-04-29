<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ProductForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\Product;
use app\models\Cart;
use yii\helpers\FileHelper;
use app\models\Receipt;
use app\models\PaymentForm;
use yii\helpers\Html;

class GuitarsaitController extends Controller{


    //  домашняя страница
    public function actionHome()
    {
        $categories = [
            [
                'title' => 'Гитары',
                'image' => 'images/categories/guitars.jpg',
                'params' => ['category' => 'guitars']
            ],
            [
                'title' => 'Струны',
                'image' => 'images/categories/strings.jpg',
                'params' => ['category' => 'strings']
            ],
            [
                'title' => 'Аксессуары',
                'image' => 'images/categories/accessories.jpg',
                'params' => ['category' => 'accessories']
            ],
            [
                'title' => 'Чехлы и кейсы',
                'image' => 'images/categories/cases.jpg',
                'params' => ['category' => 'cases']
            ],
            [
                'title' => 'Педали эффектов',
                'image' => 'images/categories/pedals.jpg',
                'params' => ['category' => 'pedals']
            ],
            [
                'title' => 'Усилители',
                'image' => 'images/categories/amplifiers.jpg',
                'params' => ['category' => 'amplifiers']
            ]
        ];

        return $this->render('home', [
            'categories' => $categories
        ]);
    }

    public function actionCategory($category)
    {
        $validCategories = ['guitars', 'strings', 'accessories', 'cases', 'pedals', 'amplifiers'];
        
        if (!in_array($category, $validCategories)) {
            throw new \yii\web\NotFoundHttpException('Категория не найдена');
        }

        $categoryTitles = [
            'guitars' => 'Гитары',
            'strings' => 'Струны',
            'accessories' => 'Аксессуары',
            'cases' => 'Чехлы и кейсы',
            'pedals' => 'Педали эффектов',
            'amplifiers' => 'Усилители'
        ];

        $products = Product::findAll(['category' => $category]);

        return $this->render('category', [
            'products' => $products,
            'categoryName' => $category,
            'categoryTitle' => $categoryTitles[$category] ?? ucfirst($category)
        ]);
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
        $products = Product::find()
            ->where(['like', 'name', $query])
            ->orWhere(['like', 'description', $query])
            ->all();
            
        return $this->render('search', [
            'products' => $products,
            'query' => $query
        ]);
    }

    public function actionAddToCart($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $product = Product::findOne($id);
        if ($product) {
            Cart::addToCart($id);
            return [
                'success' => true,
                'message' => 'Товар добавлен в корзину'
            ];
        } 
        return [
            'success' => false,
            'message' => 'Товар не найден'
        ];
    }

    public function actionClearCart()
    {
        Cart::clearCart();
        Yii::$app->session->setFlash('success', 'Корзина очищена');
        return $this->redirect(['home']);
    }

    public function actionRemoveFromCart($id)
    {
        Cart::removeFromCart($id);
        Yii::$app->session->setFlash('success', 'Товар удален из корзины');
        return $this->redirect(['korzina']);
    }

    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            // Отладочная информация
            Yii::error('POST данные: ' . print_r($_POST, true));
            
            // Проверяем, был ли загружен файл
            if (isset($_FILES['Product']) && isset($_FILES['Product']['tmp_name']['imageFile']) && !empty($_FILES['Product']['tmp_name']['imageFile'])) {
                $tmpName = $_FILES['Product']['tmp_name']['imageFile'];
                $name = $_FILES['Product']['name']['imageFile'];
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                
                // Отладка информации о файле
                Yii::error('Загруженный файл: ' . print_r($_FILES['Product'], true));
                
                // Проверяем расширение файла
                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                if (!in_array(strtolower($ext), $allowedExtensions)) {
                    Yii::$app->session->setFlash('error', 'Допустимы только изображения в форматах: png, jpg, jpeg');
                    return $this->render('create', [
                        'model' => $model,
                        'categories' => [
                            'guitars' => 'Гитары',
                            'strings' => 'Струны',
                            'accessories' => 'Аксессуары',
                            'cases' => 'Чехлы и кейсы',
                            'pedals' => 'Педали эффектов',
                            'amplifiers' => 'Усилители'
                        ]
                    ]);
                }

                // Создаем директорию, если она не существует
                $uploadPath = Yii::getAlias('@webroot/uploads');
                if (!file_exists($uploadPath)) {
                    FileHelper::createDirectory($uploadPath, 0777, true);
                }

                // Генерируем уникальное имя файла
                $fileName = 'product_' . time() . '.' . $ext;
                $filePath = $uploadPath . '/' . $fileName;

                // Копируем файл
                if (copy($tmpName, $filePath)) {
                    $model->image = $fileName;
                    Yii::error('Файл успешно скопирован: ' . $filePath);
                } else {
                    Yii::error('Ошибка при копировании файла');
                    Yii::$app->session->addFlash('error', 'Ошибка при загрузке файла');
                }
            }

            try {
                // Проверяем данные перед сохранением
                Yii::error('Данные модели перед сохранением: ' . print_r($model->attributes, true));
                
                // Проверяем подключение к базе данных
                try {
                    Yii::$app->db->open();
                } catch (\Exception $e) {
                    Yii::error('Ошибка подключения к БД: ' . $e->getMessage());
                    Yii::$app->session->addFlash('error', 'Ошибка подключения к базе данных: ' . $e->getMessage());
                    throw $e;
                }
                
                if ($model->validate()) {
                    Yii::error('Валидация прошла успешно');
                    
                    // Пробуем сохранить модель и записываем SQL-запрос в лог
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($model->save(false)) {
                            $transaction->commit();
                            Yii::error('Товар успешно сохранен с ID: ' . $model->id);
                            Yii::$app->session->setFlash('success', 'Товар успешно добавлен');
                            return $this->redirect(['home']);
                        } else {
                            $transaction->rollBack();
                            Yii::error('Ошибка при сохранении: ' . print_r($model->errors, true));
                            Yii::$app->session->addFlash('error', 'Ошибка при сохранении товара: ' . print_r($model->errors, true));
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                } else {
                    Yii::error('Ошибки валидации: ' . print_r($model->errors, true));
                    foreach ($model->errors as $attribute => $errors) {
                        foreach ($errors as $error) {
                            Yii::$app->session->addFlash('error', "$attribute: $error");
                        }
                    }
                }
            } catch (\Exception $e) {
                Yii::error('Исключение при сохранении: ' . $e->getMessage());
                Yii::$app->session->addFlash('error', 'Произошла ошибка: ' . $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => [
                'guitars' => 'Гитары',
                'strings' => 'Струны',
                'accessories' => 'Аксессуары',
                'cases' => 'Чехлы и кейсы',
                'pedals' => 'Педали эффектов',
                'amplifiers' => 'Усилители'
            ]
        ]);
    }

    public function actionPayment()
    {
        $cartItems = Cart::getCart();
        $total = Cart::getTotal();

        if (empty($cartItems) || $total <= 0) {
            Yii::$app->session->setFlash('error', 'Корзина пуста');
            return $this->redirect(['korzina']);
        }

        $model = new PaymentForm();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                try {
                    // Создаем чек в базе данных
                    $receipt = Receipt::createFromCart($cartItems, $model->cardNumber);
                    
                    // Очищаем корзину после успешной оплаты
                    Cart::clearCart();
                    
                    // Перенаправляем на страницу чека
                    return $this->redirect(['receipt', 'id' => $receipt->id]);
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', 'Ошибка при обработке платежа: ' . $e->getMessage());
                }
            }
        }

        return $this->render('payment', [
            'model' => $model,
            'total' => $total,
        ]);
    }

    public function actionReceipt($id)
    {
        $receipt = Receipt::find()
            ->with('items') // Загружаем связанные товары
            ->where(['id' => $id])
            ->one();
        
        if (!$receipt) {
            Yii::$app->session->setFlash('error', 'Чек не найден');
            return $this->redirect(['home']);
        }
        
        return $this->render('receipt', [
            'receipt' => $receipt
        ]);
    }

    public function actionNew()
    {
        $categories = [
            'guitars', 'strings', 'accessories', 'cases', 'pedals', 'amplifiers'
        ];
        $newProducts = [];
        foreach ($categories as $category) {
            $product = Product::find()->where(['category' => $category])->orderBy('RAND()')->one();
            if ($product) {
                $newProducts[] = $product;
            }
        }
        return $this->render('new', [
            'products' => $newProducts
        ]);
    }

    public function actionAddAllToCart()
    {
        $isAjax = Yii::$app->request->isAjax;
        
        $ids = Yii::$app->request->post('ids', []);
        if (is_array($ids) && !empty($ids)) {
            foreach ($ids as $id) {
                Cart::addToCart($id);
            }
            
            if ($isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                Yii::$app->session->setFlash('success', 'Набор товаров успешно добавлен в корзину!');
                return [
                    'success' => true,
                    'message' => 'Все товары добавлены в корзину!',
                    'redirect' => \yii\helpers\Url::to(['korzina'])
                ];
            } else {
                Yii::$app->session->setFlash('success', 'Набор товаров успешно добавлен в корзину!');
                return $this->redirect(['korzina']);
            }
        }
        
        if ($isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'success' => false,
                'message' => 'Не выбраны товары'
            ];
        }
        
        Yii::$app->session->setFlash('error', 'Не выбраны товары');
        return $this->redirect(['korzina']);
    }

    // Убедитесь, что у вас есть метод behaviors() для настройки CSRF
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'payment' => ['post', 'get'], // Разрешаем оба метода
                ],
            ],
        ];
    }

}