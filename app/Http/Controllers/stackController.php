<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stack;

class stackController extends Controller
{
    function GetStackData() {
        $stack = stack::all();

        return response($stack->toArray(), 200);
    }

    function WriteStackData(Request $request) {
        stack::insert([
           'article' => $request->article,
           'description' => $request->description
        ]);

        return response('성공', 201);
    }
}
