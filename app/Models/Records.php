<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Records extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $table="supervisor_records";
    use HasFactory;

  

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
   
    }


}
