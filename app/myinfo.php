<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class myinfo extends Model
{
    protected $table = 'myinfo';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kind', 'info_date'
    ];
}
