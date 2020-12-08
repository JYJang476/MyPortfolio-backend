<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'img_id', 'ppt_no', 'board_id', 'project_id', 'ppt_date'
    ];
}
