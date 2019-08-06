<?php

namespace app\services;

use app\models\Order;

class StatisticService
{
    public static function getTopCustomers($count = 10)
    {
        return (new \yii\db\Query())
            ->select([
                'c.name as customer_name',
                'SUM(`o`.`count_tickets`) as sum',
            ])
            ->from('customer c')
            ->leftJoin('order o', '`c`.`id` = `o`.`customer_id`')
            ->where(['o.status' => Order::STATUS_COMPLETED])
            ->groupBy('c.id')
            ->having('sum')
            ->orderBy('sum DESC')
            ->limit($count);

    }
}