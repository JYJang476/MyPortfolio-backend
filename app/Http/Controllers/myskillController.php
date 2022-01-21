<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\myskill;

class myskillController extends Controller
{
    public function RegistrySkill(Request $request) {
        $resultUrl = $request->file('icon')->store("icons");

        myskill::insert([
            'icon' => $resultUrl,
            'title' => $request->title,
            'tag' => $request->tag
        ]);

        return response('성공', 201);
    }

    public function GetSkillList(Request $request) {
        $myskill = myskill::all();

        if($myskill->count() == 0)
            return response([
                'msg' => 'not data',
                'code' => 404
            ], 404);

        return response($myskill->toArray(), 200);
    }

    public function GetSkillIcon($id) {
        $myskill = myskill::where('id', '=', $id);

        if($myskill->count() == 0)
            return response([
                'msg' => 'not data',
                'code' => 404
            ], 404);

        return response(Storage::get($myskill->first()->icon));
    }
}
