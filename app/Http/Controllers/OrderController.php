<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** Models */
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderList;
use Exception;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private $category;
    private $order;
    private $orderList;
    public function __construct(
        Order $order,
        Category $category,
        OrderList $orderList
    ) {
        $this->order = $order ;
        $this->category = $category;
        $this->orderList = $orderList ;
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllOrders()
    {
       $ordersList =  $this->order->getOrderList();

       return view('admin.orders.orders_list', compact('ordersList'));
    }

    /**
     * get Order Details.
     * @param integer $orderId
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOrderDetails(int $orderId)
    {
       $orderList =  $this->orderList->getOrdersList($orderId);
       $orderUser =  $this->order->getOrderUserData($orderId);
       return view('admin.orders.manage_orders', compact('orderList', 'orderUser'));
    }

}
