<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentDataHandling extends Model
{
    use HasFactory;
    protected $table = 'payment_data_handling';
    public $timestamps = true;


}