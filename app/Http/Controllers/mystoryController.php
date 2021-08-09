<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\MyStoryModel;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class mystoryController
{
    // 글을 쓴다.
    public function WriteMyStory(Request $request) {
        $tags = json_decode($request->tag)->tag;

        $result = MyStoryModel::insert([
            'title' => $request->title,
            'content' => $request->content,
            'writer' => $request->writer, // 추후 수정 예정
        ]);

        if(!$result)
            return response([
                'msg' => '실패',
                'data' => []
            ], 403);

        $thisId = MyStoryModel::all()->last()->id;
        foreach($tags as $tag)
            Tag::insert([
                'tag' => $tag,
                'storyId' => $thisId
            ]);

        return response([
            'msg' => '성공',
            'data' => ['id' => $thisId]
        ]);
    }

    // 글 목록을 가져 온다.
    public function getMyStorys($page) {
        $results = MyStoryModel::orderBy('id', 'DESC')
            ->offset(($page - 1) * 15)
            ->limit(15)->get();
        $story = MyStoryModel::all();
        $pageCount = round($story->count() / 15);

        return response([
            'msg' => '성공',
            'data' => ['storys' => $results->toArray(),
                'pageCount' => $pageCount
            ]
        ]);
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
        $story = MyStoryModel::where('id', $id)->first();
        $tag = Tag::where('storyId', '=', $id)->get();

        return response([
                'msg' => '성공',
                'data' => [
                    'story' => $story,
                    'tag' => $tag->toArray()
                ]
            ]);
    }

    // 글 검색
    public function getFindMyStory(Request $request) {
        $story = MyStoryModel::select(['mystory.id', 'mystory.title', 'mystory.content', 'mystory.date', 'tag.tag'])
                ->join('tag', 'mystory.id', '=', 'tag.storyId')
                ->where('tag.tag', 'like', "{$request->input('schValue')}%")->get();

        if($story->count() == 0)
            return response('<div>검색결과가 없습니다.</div>', 404);

        return response([
            'msg' => '성공',
            'data' => [
                'storys' => $story->toArray(),
                'pageCount' => $story->count()
            ]
        ]);
    }

    // 글을 삭제 한다.
    public function DeleteMyStory(Request $request, $id) {
        $auth = $request->header("Authorization");
        $tokenArray = explode(" ", $auth);
        $tokenEx = explode(".", $tokenArray[1]);
        $paramUserId = json_decode(base64_decode($tokenEx[1].'=='))->userId;

        $target = MyStoryModel::firstWhere('id', $id);

        if($target->writer != $paramUserId)
            return response([
                'code' => 405,
                'msg' => '유효한 토큰이 아닙니다.'
            ], 403);

        $target->delete();

        return response([
            'msg' => '성공',
            'data' => []
        ]);
    }

    // 글을 수정한다.
    public function EditMyStory(Request $request, $id) {
        $result = MyStoryModel::where('id', $id)->update([
            'title' => $request->txtTitle,
            'content' => $request->txtContent,
            'tag' => $request->tag
        ]);

        return response([
            'msg' => '성공',
            'data' => [
                'id' => $id
            ]
        ]);
    }
}
