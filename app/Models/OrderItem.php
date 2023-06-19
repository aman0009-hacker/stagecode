<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
