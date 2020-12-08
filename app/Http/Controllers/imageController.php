<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\image;

class imageController extends Controller
{
    public function showImage($id) {
        $table = image::where('id', $id)->first();
        return response(Storage::get($table->img_url), 200);
    }
}
