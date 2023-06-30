<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentHandling extends Model
{
    use HasFactory;
    protected $table = 'payment_handling';
    public $timestamps = true;


}