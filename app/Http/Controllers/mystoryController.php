<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\MyStoryModel;
use Illuminate\Support\Facades\Auth;

class mystoryController extends Controller
{
    // 글을 쓴다.
    public function WriteMyStory(Request $request) {
        if (Auth::check()) {
            $result = MyStoryModel::insert([
                'title' => $request->input('txtTitle'),
                'content' => $request->input('txtContent'),
                'writer' => Auth::user()->name,
            ]);

            $thisId = MyStoryModel::all()->last()->id;
            return redirect('index/mystory/'.$thisId);
        }
    }

    // 글목록을 가져 온다.
    public function getMyStorys(Request $request) {
        $results = MyStoryModel::all();
        $first = MyStoryModel::all()->first();
        return view('mystory', ['storys' => $results->toArray(),
                                'story' => $first]);
    }

    // 해당 글의 번호를 반환
    public function getMyStoryNo($id) {
        $story = MyStoryModel::select('id', 'title')->where('id', $id)->first();

        if($story->count() > 0) {
            return response([
                'id' => $story->id,
                'title' => $story->title
            ], 200);
        }

        return response('fail', 404);
    }

    // 글을 가져온다.
    public function getMyStory(Request $request, $id) {
        $results = MyStoryModel::all();
        $story = MyStoryModel::where('id', $id)->first();
        return view('mystory', ['storys' => $results->toArray(),
                                'story' => $story]);
    }

    // 글 수정 페이지로 이동
    public function goEdit(Request $request, $id) {
        if (Auth::check()) {
            $story = MyStoryModel::where('id', $id)->first();
            return view('edit', ['story' => $story]);
        }
    }

    public function getFindMyStory(Request $request) {
        $story = MyStoryModel::where('title', 'like', "{$request->input('schValue')}%")->get();

        if($story->count() == 0)
            return response('<div>검색결과가 없습니다.</div>', 404);

        return response($story->toArray(), 200);
    }

    // 글을 삭제 한다.
    public function DeleteMyStory(Request $request, $id) {
        if (Auth::check()) {
            $result = MyStoryModel::firstWhere('id', $id)->delete();
            return redirect('index/mystory');
        }
    }

    // 글을 수정한다.
    public function EditMyStory(Request $request, $id) {
        if (Auth::check()) {
            $result = MyStoryModel::where('id', $id)->update([
                'title' => $request->input('txtTitle'),
                'content' => $request->input('txtContent')
            ]);
            return redirect('index/mystory/'.$id);
        }
    }
}
