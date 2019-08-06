<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%location}}`
 */
class m190806_102551_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->text()->notNull(),
            'date'        => $this->timestamp(),
            'location_id' => $this->integer(),
        ]);

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-event-location_id}}',
            '{{%event}}',
            'location_id'
        );

        // add foreign key for table `{{%location}}`
        $this->addForeignKey(
            '{{%fk-event-location_id}}',
            '{{%event}}',
            'location_id',
            '{{%location}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%location}}`
        $this->dropForeignKey(
            '{{%fk-event-location_id}}',
            '{{%event}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-event-location_id}}',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
