<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Address extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';


    protected $table = 'address';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();


        parent::boot();

        static::creating(function ($address) {
            // Set the default value for 'psiec_address_ludhiana'
            $defaultAddress = [
                "psiec_biilling_name" => "Punjab Small Industries & Export Corp. Ind.",
                "psiec_billing_area" => "Area-B",
                "psiec_biilling_city" => "Ludhiana",
                "psiec_biilling_gst" => "03AABCP1602M1ZT",
                "psiec_biilling_state" => "Punjab",
                "psiec_biilling_code" => "03",
                "psiec_biilling_cin" => "U51219CH9162SGC002427",
            ];
            $address->psiec_address_ludhiana = json_encode($defaultAddress);

            // Generate and set the UUID for the primary key
            $address->{$address->getKeyName()} = Uuid::generate()->string;
        });

    }
}