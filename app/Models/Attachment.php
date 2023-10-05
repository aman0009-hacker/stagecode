<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Crypt;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permisssion\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Traits\HasEditable;

class Attachment extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'attachments';
    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'filename',
        'fileno',
        'file_type'
    ];


    //new code for logActivity start
    protected static $logAttributes = ["filename", "fileno", "file_type"];
    protected static $logOnlyDirty = true;
    protected static $logName = 'attachment';
    protected static $recordEvents = ["created", "updated", "deleted"];
    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = LogOptions::defaults();

        $logOptions->logAttributes = static::$logAttributes;
        $logOptions->logOnlyDirty = static::$logOnlyDirty;
        $logOptions->logName = static::$logName;
        // The getDescriptionForEvent method allows you to customize the description of logged events.
        // It is defined in your User model, and here's how you can use it:
        // $logOptions->setDescriptionForEvent(function (string $eventName) {
        //     return "you have {$eventName} user";
        // });
        return $logOptions;
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return "you have {$eventName} attachment";
    }
    //new code for logActivity start






    public function user()
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


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }



}