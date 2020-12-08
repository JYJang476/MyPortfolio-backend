<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'id';

    protected $fillable = [
        'img_url', 'img_projid', 'img_date'
    ];
}
