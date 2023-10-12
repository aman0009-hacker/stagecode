<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Entity extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $table = 'entities';

<<<<<<< HEAD
=======

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
    protected $fillable = ['name', 'description', 'size', 'diameter', 'quantity', 'remaining', 'measurement', 'entity_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}