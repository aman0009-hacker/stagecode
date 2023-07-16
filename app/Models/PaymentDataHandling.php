<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Webpatser\Uuid\Uuid;


// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentDataHandling extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'payment_data_handling';

   
    public $timestamps = true;

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
   
    }


}