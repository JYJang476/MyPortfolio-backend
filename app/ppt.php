<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ppt extends Model
{
    protected $table = 'ppt';
    protected $primaryKey = 'id';

    protected $fillable = [
        'img_id', 'ppt_no', 'board_id', 'project_id', 'ppt_date'
    ];
}
