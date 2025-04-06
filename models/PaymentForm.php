<?php

namespace app\models;

use yii\base\Model;

class PaymentForm extends Model
{
    public $cardNumber;
    public $expDate;
    public $cvv;
    public $cardHolder;

    public function rules()
    {
        return [
            // Номер карты: разрешаем ввод как с пробелами, так и без
            ['cardNumber', 'required', 'message' => 'Введите номер карты'],
            ['cardNumber', 'match', 
                'pattern' => '/^(\d{4}\s?){4}$/',
                'message' => 'Введите 16 цифр номера карты'
            ],
            
            // Срок действия: более гибкий паттерн
            ['expDate', 'required', 'message' => 'Введите срок действия'],
            ['expDate', 'match', 
                'pattern' => '/^(0[1-9]|1[0-2])\/?([0-9]{2})$/',
                'message' => 'Формат даты: ММ/ГГ'
            ],
            
            // CVV: просто 3 цифры
            ['cvv', 'required', 'message' => 'Введите CVV'],
            ['cvv', 'match', 
                'pattern' => '/^\d{3}$/',
                'message' => 'CVV: 3 цифры'
            ],
            
            // Имя держателя: разрешаем буквы обоих алфавитов
            ['cardHolder', 'required', 'message' => 'Введите имя держателя'],
            ['cardHolder', 'match', 
                'pattern' => '/^[A-ZА-Я\s]+$/u',
                'message' => 'Только заглавные буквы'
            ],
        ];
    }

    public function validateExpDate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $parts = explode('/', $this->$attribute);
            if (count($parts) == 2) {
                $month = intval($parts[0]);
                $year = intval('20' . $parts[1]);
                
                $currentYear = intval(date('Y'));
                $currentMonth = intval(date('m'));
                
                if ($year < $currentYear || 
                    ($year == $currentYear && $month < $currentMonth)) {
                    $this->addError($attribute, 'Карта просрочена');
                }
                
                if ($year > $currentYear + 10) {
                    $this->addError($attribute, 'Неверный срок действия карты');
                }
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'cardNumber' => 'Номер карты',
            'expDate' => 'Срок действия',
            'cvv' => 'CVV код',
            'cardHolder' => 'Держатель карты',
        ];
    }
} 