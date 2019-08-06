<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event}}`
 * - `{{%customer}}`
 */
class m190806_103218_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id'            => $this->primaryKey(),
            'event_id'      => $this->integer()->notNull(),
            'customer_id'   => $this->integer()->notNull(),
            'status'        => "ENUM('new','completed','canceled')",
            'count_tickets' => $this->integer(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-order-event_id}}',
            '{{%order}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-order-event_id}}',
            '{{%order}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-order-customer_id}}',
            '{{%order}}',
            'customer_id'
        );

        // add foreign key for table `{{%customer}}`
        $this->addForeignKey(
            '{{%fk-order-customer_id}}',
            '{{%order}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-order-event_id}}',
            '{{%order}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-order-event_id}}',
            '{{%order}}'
        );

        // drops foreign key for table `{{%customer}}`
        $this->dropForeignKey(
            '{{%fk-order-customer_id}}',
            '{{%order}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-order-customer_id}}',
            '{{%order}}'
        );

        $this->dropTable('{{%order}}');
    }
}
