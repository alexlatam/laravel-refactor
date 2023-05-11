<?php
namespace App\Actions;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

final class UpsertProjectAction
{
    public static function execute(User $user, Request $request): void
    {
        Project::updateOrCreate(
            // Busca el proyecto por el id en la base de datos, este id viene en la url.
            // Si el proyecto no existe en BD, se crea. En caso contrario, se actualiza.
            ['id' => request()->route('project'),],
            // Campos a actualizar o crear con los siguientes datos
            [
                'user_id' => $user->id,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ],
        );
    }
}
