<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function list(){
        $projects = Project::paginate(10);
        return view('site.project.project', compact('projects'));
    }
    public function store(ProjectRequest $request) {
        $project = new Project();
        $project->code = $request->project_code;
        $project->name = $request->project_name;
        $project->save();
        $request->session()->put('message', 'Đã thêm dự án thành công! ');
        $request->session()->put('messageType', 'success');
        return redirect()->route('project.list');
    }
    public function edit($id) {
        $project = Project::findOrFail($id);
        $projects = Project::all();
        return view('site.project.edit-project', compact('project','projects'));
    }
    public function update(ProjectRequest $request, $id) {
        $project = Project::findOrFail($id);
        $project->code = $request->project_code;
        $project->name = $request->project_name;
        $project->save();
        $request->session()->put('message', 'Đã cập nhật án thành công! ');
        $request->session()->put('messageType', 'success');
        return redirect()->route('project.list');
    }
    public function destroy($id) {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project.list')->with('massage','Đã xóa dự án thành công!');
    }
//    public function action(ProjectRequest $request){
//        if ($request->name == 'store'){
//            return redirect()->route('project.store');
//        }
//        if ($request->name == 'update'){
//            return redirect()->route('project.update');
//        }
//    }
}
