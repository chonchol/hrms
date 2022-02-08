<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $data = [
            'projects' => Project::all()
        ];

        return view('admin.project.index')->with($data);
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        Project::create([
            'name' => $request->name,
        ]);
        $request->session()->flash('success', 'Project has been successfully added');
        return redirect()->route('admin.projects.index');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit')->with('project', $project);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $project->name = $request->name;
    
        $project->save();
        $request->session()->flash('success', 'Project has been successfully updated');
        return redirect()->route('admin.projects.index');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        request()->session()->flash('success', 'Project has been successfully deleted!');
        return back();
    }
}
