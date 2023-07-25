<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentDataHandling;
// use App\Models\Invoice;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Invoice extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'invoice';
    public $timestamps = true;
    protected $primaryKey = 'id';
    

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }


    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
   
    }
}