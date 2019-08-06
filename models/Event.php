<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $location_id
 *
 * @property Location $location
 * @property Order[] $orders
 */
class Event extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date', 'location_id'], 'required'],
            [['name'], 'string'],
            [['date'], 'datetime', 'format' => 'php:d.m.Y H:i', 'timestampAttribute' => 'date'],
            [['location_id'], 'integer'],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'date'        => 'Date',
            'location_id' => 'Location ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['event_id' => 'id']);
    }


}
