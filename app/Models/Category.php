<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public $incrementing = false;
    protected $keyType = 'string';
<<<<<<< HEAD

    public $timestamps = true;

    //protected $fillable = ['name'];
=======

    public $timestamps = true;
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
    protected $fillable = ['name', 'category_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'category_id');
    }

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

}