<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location}}`.
 */
class m190806_100552_create_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id'      => $this->primaryKey(),
            'name'    => $this->text()->notNull(),
            'address' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%location}}');
    }
}
