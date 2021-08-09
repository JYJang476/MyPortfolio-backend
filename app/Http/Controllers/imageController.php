<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\image;

class imageController extends Controller
{
    public function showImage($id) {
        $table = image::where('id', $id)->first();
        return response(Storage::get($table->img_url));
    }

    public function GetImageList(Request $request) {
        $img = image::where('img_projid', '=', $request->id);

        if($img->count() == 0)
            return response('없음', 404);

        return response($img->get()->toArray(), 200);
    }
}
