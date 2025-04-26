<?php

use yii\db\Migration;

class m240319_create_receipts_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('receipts', [
            'id' => $this->primaryKey(),
            'order_id' => $this->string(50)->notNull()->unique(),
            'total_amount' => $this->decimal(10, 2)->notNull(),
            'card_last_digits' => $this->string(4)->notNull(),
            'payment_date' => $this->dateTime()->notNull(),
            'status' => $this->string(20)->notNull()->defaultValue('Оплачено'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Создаем таблицу для товаров в чеке
        $this->createTable('receipt_items', [
            'id' => $this->primaryKey(),
            'receipt_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_name' => $this->string()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'total' => $this->decimal(10, 2)->notNull(),
        ]);

        // Добавляем внешние ключи
        $this->addForeignKey(
            'fk-receipt_items-receipt_id',
            'receipt_items',
            'receipt_id',
            'receipts',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-receipt_items-product_id',
            'receipt_items',
            'product_id',
            'products',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Создаем индексы
        $this->createIndex(
            'idx-receipts-order_id',
            'receipts',
            'order_id'
        );

        $this->createIndex(
            'idx-receipts-payment_date',
            'receipts',
            'payment_date'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-receipt_items-receipt_id', 'receipt_items');
        $this->dropForeignKey('fk-receipt_items-product_id', 'receipt_items');
        $this->dropTable('receipt_items');
        $this->dropTable('receipts');
    }

    private function getCategories()
    {
        return [
            'guitars' => 'Гитары',
            'strings' => 'Струны',
            'accessories' => 'Аксессуары',
            'cases' => 'Чехлы и кейсы',
            'pedals' => 'Педали эффектов',
            'amplifiers' => 'Усилители'
        ];
    }
} 