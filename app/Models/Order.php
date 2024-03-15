<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $table ='order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'trucking_number',
        'payment_mode',
        'payment_status',
        'order_status',
    ];

    /**
     * order Creation
     *
     * @param integer|null $userId
     * @param array|null $userData
     * @return void
     */
    public function orderCreate(array $userData, int $userId) {
        return  $this->insertGetId($userData);
    }

    /**
     * User
     *
     * @return void
     */
    public function users() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * Get order list
     *
     */
    public function getOrderList() {
        return  $this->join('users', 'users.id', '=', 'order.user_id')
                ->select(
                    'users.email',
                    'users.name',
                    'users.last_name',
                    'users.phone',
                    'users.address',
                    'users.pin_number',
                    'users.role',
                    'users.id as userid',
                    'users.name as user_name',
                    'order.*',
                    )
                ->get();
    }

    /**
     * Get order user details
     * @param integer $orderId
     */
    public function getOrderUserData(int $orderId) {
        return  $this->join('users', 'users.id', '=', 'order.user_id')
                ->select(
                    'users.email',
                    'users.name',
                    'users.last_name',
                    'users.phone',
                    'users.address',
                    'users.pin_number',
                    'users.role',
                    'users.id as userid',
                    'users.name as user_name',
                    // 'order.*',
                    )
                ->where('order.id', $orderId)->get();
    }
}
