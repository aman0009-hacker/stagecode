<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name'];
    public $incrementing = false;
    protected $keyType = 'string'; 
  
    public $timestamps = true;

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

  
}
