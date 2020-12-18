<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\project;
use App\ppt;
use App\image;

class projectController extends Controller
{
    // 글을 쓴다.
    public function WriteProject(Request $request) {
        if (Auth::check()) {
            $files = [];
            // 이미지들을 담는 작업
            for($i = 0; $request->file('file'.$i) != null; $i++) {
                array_push($files, $request->file('file'.$i));
            }

            $techs = json_decode($request->input('techJson'));

            $result = project::insert([
                'img_id' => 1,
                'project_name' => $request->input('txtTitle'),
            ]);

            if(!$result)
                return redirect('index/project/');

            $projectId = project::all()->last()->id;
            $techs = json_decode($request->input('techJson'));
            $i = 0;
            foreach($files as $file) {
                image::insert([
                    'img_url' => $file->store('images'),
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

            return redirect('index/project/'.$projectId);
        }
    }

    public function showProject($id) {
        $imgList = [];
        $storyList = [];
        $subProj = project::select('image.id', 'ppt.board_id')
            ->join('image', 'project.id', '=', 'image.img_projid')
            ->join('ppt', 'project.id', '=', 'ppt.project_id')
            ->where('project.id', $id);

        $project = project::select()->from($subProj)->distinct();

        if ($project->get()->count() == 0) {
            $project = project::select()
                ->where('project.id', $id);

            return view('view', [
                'title' => $project->first()->project_name,
                'b_id' => $storyList,
                'img_id' => $imgList
            ]);
        }

        foreach($project->get() as $proj){
            array_push($imgList, $proj->id);
            array_push($storyList, $proj->board_id);
        }

        // 이름, 날짜, ppt 이미지
       return view('view', [
            'title' => $project->first()->project_name,
            'b_id' => $storyList,
            'img_id' => $imgList
        ]);
    }

    public function showProjectList() {
        $project = project::select('project_name', 'img_id', 'id')->paginate(6);

        return view('project', [
           'project' => $project
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

        return response('delete success!', 200);
    }
}
