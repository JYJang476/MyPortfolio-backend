<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyStoryModel extends Model
{
    protected $table = "mystory";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title', 'content', 'writer',
    ];
}
