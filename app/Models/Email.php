<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    protected $fillable = ['from', 'to', 'subject', 'body', 'avatar', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Email::class, 'parent_id');
    }

    // Balasan
    public function replies()
    {
        return $this->hasMany(Email::class, 'parent_id');
    }

    // relasi ke user pengirim
    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }

    // relasi ke user penerima
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to');
    }

}
