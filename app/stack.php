<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stack extends Model
{
    protected $table = 'stack';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'article', 'description'
    ];
}
