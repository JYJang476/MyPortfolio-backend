<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class myskill extends Model
{
    protected $table = 'myskill';
    protected $primaryKey = 'id';

    protected $fillable = [
        'icon', 'title', 'tag'
    ];
}
