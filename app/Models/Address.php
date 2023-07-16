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

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
   
    }
}