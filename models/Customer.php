<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 *
 * @property Order[] $orders
 */
class Customer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            [['name', 'email', 'phone'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'name'  => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }


}
