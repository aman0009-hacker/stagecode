<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;


class Comments extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'comments';
    public $timestamps = true;
    use HasFactory;

    protected $encryptable = [

        'comment',

    ];

    public function setCommentAttribute($value)
    {
        if (in_array('comment', $this->encryptable)) {
            $this->attributes['comment'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['comment'] = $value;
        }
    }

    public function getCommentAttribute($value)
    {
        if (in_array('comment', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}