<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\Admin\ProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['is_published'] = $request->has('is_published');
        
        // Convert comma-separated string to array
        if (!empty($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        } else {
            $data['tech_stack'] = [];
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('projects', $filename, 'public');
            $data['image'] = $path;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['is_published'] = $request->has('is_published');

        if (!empty($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        } else {
            $data['tech_stack'] = [];
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $file = $request->file('image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('projects', $filename, 'public');
            $data['image'] = $path;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
