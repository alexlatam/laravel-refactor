<?php

namespace App\ViewModels;

use App\Models\Project;

// Este ViewModel retornara todos los datos necesarios para las vistas de creacion y actualizacion de proyectos
final class UpsertProjectViewModel extends ViewModel
{

    // Recibe un objeto Project, o null
    public function __construct(public ?Project $project) {}

    /* Este metodo es llamado desde el metodo toArray() de la clase ViewModel
     * Este metodo retorna un array con los datos necesarios para las vistas de creacion y actualizacion de proyectos,
     * dependiendo si se recibe un objeto Project o null
     */
    public function formData(): array
    {
        return ($this->project) ? $this->updateFormData() : $this->createFormData();
    }

    protected function createFormData(): array
    {
        $project = new Project;
        $title = __('Crear proyecto');
        $textButton = __('Crear');
        $route = route('projects.store');
        return compact('title', 'textButton', 'route', 'project');
    }

    protected function updateFormData(): array
    {
        $project = $this->project;
        $update = true;
        $title = __('Editar proyecto');
        $textButton = __('Actualizar');
        $route = route('projects.update', ['project' => $this->project]);
        return compact('update', 'title', 'textButton', 'route', 'project');
    }

}
