<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 06.08.19
 * Time: 18:57
 */

namespace app\commands;


use app\models\Customer;
use app\models\Event;
use app\models\Location;
use app\models\Order;
use yii\console\Controller;
use yii\console\ExitCode;
use Faker;
use yii\helpers\ArrayHelper;


class GenerateDataController extends Controller
{

    public function actionIndex($count)
    {
        $faker = Faker\Factory::create('ru_RU'); // create a Russian faker
        $this->fakeLocation($faker, $count);
        $this->fakeEvent($faker, $count);
        $this->fakeCustomer($faker, $count);
        $this->fakeOrder($faker, $count);


        return ExitCode::OK;
    }

    private function fakeLocation(Faker\Generator $faker, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $location          = new Location();
            $location->name    = $faker->company;
            $location->address = $faker->address;
            $location->save();
        }
    }

    private function fakeEvent(Faker\Generator $faker, $count)
    {
        $locationIds = ArrayHelper::getColumn(Location::find()->all(), 'id');
        for ($i = 0; $i < $count; $i++) {
            $event              = new Event();
            $event->name        = $faker->companySuffix . $faker->word;
            $event->date        = $faker->dateTime->getTimestamp();
            $event->location_id = $locationIds[array_rand($locationIds)];
            $event->save();
        }
    }

    private function fakeCustomer(Faker\Generator $faker, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $customer        = new Customer();
            $customer->name  = $faker->name;
            $customer->email = $faker->email;
            $customer->phone = $faker->phoneNumber;
            $customer->save();
        }
    }

    private function fakeOrder(Faker\Generator $faker, $count)
    {
        $eventIds    = ArrayHelper::getColumn(Event::find()->all(), 'id');
        $customerIds = ArrayHelper::getColumn(Customer::find()->all(), 'id');
        for ($i = 0; $i < $count; $i++) {
            $order                = new Order();
            $order->event_id      = $eventIds[array_rand($eventIds)];
            $order->customer_id   = $customerIds[array_rand($customerIds)];
            $order->status        = Order::$statuses[array_rand(Order::$statuses)];
            $order->count_tickets = $faker->numberBetween(1, 200);
            $order->save();
        }
    }
}