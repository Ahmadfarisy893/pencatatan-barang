<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    protected $fillable = ['from', 'to', 'subject', 'body', 'avatar',];
}
