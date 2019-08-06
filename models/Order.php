<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $event_id
 * @property int $customer_id
 * @property string $status
 * @property int $count_tickets
 *
 * @property Customer $customer
 * @property Event $event
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    static $statuses = [self::STATUS_NEW, self::STATUS_COMPLETED, self::STATUS_CANCELED];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'customer_id'], 'required'],
            [['event_id', 'customer_id', 'count_tickets'], 'integer'],
            [['status'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'event_id'      => 'Event ID',
            'customer_id'   => 'Customer ID',
            'status'        => 'Status',
            'count_tickets' => 'Count Tickets',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
