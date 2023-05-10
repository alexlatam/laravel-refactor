<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\ViewModels\UpsertProjectViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{

    public function index(): View
    {
        $projects = Project::with('user')->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create(): View
    {
        $viewModel = new UpsertProjectViewModel(null);
        return view('projects.create', $viewModel->toArray()['form_data']);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $request->merge(['user_id' => auth()->id()]);
        Project::create($request->only('user_id', 'name', 'description'));

        return redirect(route('projects.index'))->with('success', __('¡Proyecto creado!'));
    }

    public function edit(Project $project): View
    {
        $viewModel = new UpsertProjectViewModel($project);
        return view('projects.edit', $viewModel->toArray()['form_data']);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->fill($request->only('name', 'description'))->save();
        return back()->with('success', __('¡Proyecto actualizado!'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return back()->with('success', __('¡Proyecto eliminado!'));
    }
}
