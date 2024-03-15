<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $table ='order_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'tax_amount',
        'quantity',
    ];

    /**
     * orders List Creation
     *
     * @param integer|null $userId
     * @param array|null $orderItems
     * @return void
     */
    public function createOrderList(array $orderItems, int $userId) {
        return  $this->insertGetId($orderItems);
    }

    /**
     * User
     *
     * @return void
     */
    public function Orders() {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    /**
     * orders List Creation
     *
     * @param integer|null $orderId
     * @return array
     */
    public function getOrdersList(int $orderId) {
        return  $this->join('order', 'order.id', '=', 'order_list.order_id')
                    ->join('tbl_product', 'tbl_product.id', '=', 'order_list.product_id')
                    ->join('users', 'users.id', '=', 'order.user_id')
                    ->select(
                        'users.email',
                        'users.last_name',
                        'users.phone',
                        'users.address',
                        'users.pin_number',
                        'users.role',
                        'users.id as user_id',
                        'users.name as user_name',
                        'tbl_product.*',
                        'tbl_product.id as productid',
                        'order.id as order_id',
                        'order.trucking_number',
                        'order.payment_mode',
                        'order.payment_status',
                        'order.order_status',
                        'order_list.id as order_list_id',
                        'order_list.*',
                        )
                    ->where('order.id', $orderId)->get();
    }
}
