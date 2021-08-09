<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'token', 'user_no', 'date'
    ];
}
