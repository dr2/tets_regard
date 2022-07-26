<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Manager;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function index()
    {
        // вывод 50ти заказов одним запросом
        $orders = Order::withManager()->take(50)->get();

        foreach ($orders as $order) {
            echo $order->id . ' - ' . $order->fullname . '<br />';
        }
    }
}
