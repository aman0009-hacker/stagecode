<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Webpatser\Uuid\Uuid;
use App\Models\PaymentDataHandling;
use App\Models\Invoice;
use App\Models\User;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'orders';
    public $timestamps = true;


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'order_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'order_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentDataHandling::class, 'order_id', 'id');
    }
    
    // protected static function boot(){
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = Uuid::generate()->string;

    //     });
   
    // }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate and set the UUID
            $order->{$order->getKeyName()} = Uuid::generate()->string;

            // Get the latest order number from the database
            $latestOrder = static::latest()->first();

            // Extract the numeric part from the latest order number
            $latestNumber = $latestOrder ? intval(substr($latestOrder->order_no, strlen('psiec_'))) : 0;

            // Increment the numeric part and set the new order number
            $order->order_no = 'PSIEC-' . ($latestNumber + 1);
        });
    }
}