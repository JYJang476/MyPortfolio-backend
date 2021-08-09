<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\project;
use App\MyStoryModel;
use App\ppt;
use App\image;

class projectController extends Controller
{
    // 글을 쓴다.
    public function WriteProject(Request $request) {
        $files = [];
        // 이미지들을 담는 작업
        for($i = 0; $request->file('file'.$i) != null; $i++) {
            array_push($files, $request->file('file' . $i)->store("images"));
        }

        $result = project::insert([
            'img_id' => 1,
            'project_name' => $request->title,
        ]);

        if(!$result)
            return response([
                'msg' => '실패',
                'data' => []
            ]);

        $projectId = project::all()->last()->id;
        $techs = json_decode($request->techJson);
        $i = 0;
        foreach($files as $file) {
            image::insert([
                'img_url' => $file,
                'img_projid' => $projectId
            ]);
            $imgId = image::all()->last()->id;
            ppt::insert([
                'img_id' => $imgId,
                'ppt_no' => $i + 1,
                'board_id' => $techs[$i],
                'project_id' => $projectId,
            ]);
            if($i == 0)
                project::where('id', $projectId)->update([
                    'img_id' => $imgId
                ]);
            $i++;
        }

        return response([
            'msg' => '성공',
            'data' => $projectId
        ]);
    }

    // 글을 수정한다..
    public function EditProject(Request $request) {
        $files = [];
        // 이미지들을 담는 작업
        for($i = 0; $request->file('file'.$i) != null; $i++)
            array_push($files, $request->file('file' . $i)->store("images"));

        // 삭제 이미지 처리
        foreach ($request->removeimg as $img)
            ppt::where('id', '=', $img->id)->delete();

        // 프로젝트 수정
        $result = project::insert([
            'img_id' => 1,
            'project_name' => $request->title,
        ]);

        if(!$result)
            return response([
                'msg' => '실패',
                'data' => []
            ]);

        $projectId = project::all()->last()->id;
        $techs = json_decode($request->techJson);
        $i = 0;
        foreach($files as $file) {
            image::insert([
                'img_url' => $file,
                'img_projid' => $projectId
            ]);
            $imgId = image::all()->last()->id;
            ppt::insert([
                'img_id' => $imgId,
                'ppt_no' => $i + 1,
                'board_id' => $techs[$i],
                'project_id' => $projectId,
            ]);
            if($i == 0)
                project::where('id', $projectId)->update([
                    'img_id' => $imgId
                ]);
            $i++;
        }

        return response([
            'msg' => '성공',
            'data' => $projectId
        ]);
    }

    public function showProject($id) {
        $imgList = [];
        $storyList = [];
        $subProj = project::select('image.id', 'ppt.board_id', 'project.project_name')
            ->join('image', 'project.id', '=', 'image.img_projid')
            ->join('ppt', 'project.id', '=', 'ppt.project_id')
            ->where('project.id', $id);

        $project = project::select()->from($subProj)->distinct();

        // mystory를 얻어온다.
        $projStory = MyStoryModel::join('ppt', 'mystory.id', 'ppt.board_id')
            ->where('ppt.project_id', '=', $id);

        if ($project->get()->count() == 0) {
            $project = project::select()
                ->where('project.id', $id);

            return response([
                'msg' => '성공',
                'data' => [
                    'title' => $project->first()->project_name,
                    'storys' => $projStory->get()->toArray(),
                    'img_id' => $imgList
                ]
            ]);
        }

        foreach($project->get() as $proj)
            array_push($imgList, $proj->id);

        // 이름, 날짜, ppt 이미지
       return response([
            'msg' => '성공',
            'data' => [
                'title' => $project->first()->project_name,
                'storys' => $projStory->get()->toArray(),
                'img_id' => $imgList
            ]
       ]);
    }

    public function showProjectList($page) {
        $project = project::select('project_name', 'img_id', 'id')->orderBy('id', 'DESC')
            ->offset(($page - 1) * 30)
            ->limit(30)->get();
        $pageCount = ceil(project::all()->count() / 30);

        if($project->count() == 0)
            return response('실패', 404);

        return response([
            'msg' => '성공',
            'data' => [
                'project' => $project->toArray(),
                'pageCount' => $pageCount
            ]
        ]);
    }

    public function deleteProject($id) {
        $targetFiles = [];

        $imgs = image::where('img_projid', $id)->get();

        foreach($imgs as $img)
            array_push($targetFiles, $img->img_url);

        Storage::delete($targetFiles);

        if(!image::where('img_projid', $id)->delete())
            return response('image delete fail', 404);

        if(!ppt::where('project_id', $id)->delete())
            return response('ppt delete fail', 404);

        if(!project::where('id', $id)->delete())
            return response('project delete fail', 404);

        return response([
            'msg' => '성공',
            'data' => []
        ]);
    }
}
