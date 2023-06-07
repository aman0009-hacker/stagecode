<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;


use Encore\Admin\Traits\HasEditable;

class Attachment extends Model
{
    use HasFactory;
    protected $table = 'attachments';
    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string'; 


protected $fillable = [ 'filename',
'fileno',
'file_type'
];
    

      public function  user()
    {
        return $this->belongsTo(User::class);
    }

    protected $encryptable = [

        'filename',
        'fileno',
        'file_type'
     
        
    ];

    public function setFileNameAttribute($value)
    {
        if (in_array('filename', $this->encryptable)) {
            $this->attributes['filename'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['filename'] = $value;
        }
    }
    
    public function getFileNameAttribute($value)
    {
        if (in_array('filename', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }

    public function setFileNoAttribute($value)
    {
        if (in_array('fileno', $this->encryptable)) {
            $this->attributes['fileno'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['fileno'] = $value;
        }
    }
    
    public function getFileNoAttribute($value)
    {
        if (in_array('fileno', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }

    public function setFileTypeAttribute($value)
    {
        if (in_array('file_type', $this->encryptable)) {
            $this->attributes['file_type'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
        } else {
            $this->attributes['file_type'] = $value;
        }
    }
    
    public function getFileTypeAttribute($value)
    {
        if (in_array('file_type', $this->encryptable)) {
            return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
        }
        return $value;
    }


    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }

    

}
