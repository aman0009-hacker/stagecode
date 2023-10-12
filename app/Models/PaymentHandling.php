<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use App\Models\OrderItem;


>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea

class PaymentHandling extends Model
{
    use HasFactory;
    protected $table = 'payment_handling';
    public $timestamps = true;


}