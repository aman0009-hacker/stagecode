<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $timestamps = true;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}