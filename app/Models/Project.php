<?php

namespace App\Models;

use App\Models\Builders\ProjectBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Project extends Base\Project
{
    // Un nuevo metodo para los builders de Eloquent referentes a este Modelo
    // USO: En los controladores: Porject::forCurrentUser()->get();
    // public function scopeForCurrentUser(Builder $builder): Builder
    // {
    //    return $builder->where('user_id', auth()->id());
    // }

    /**
     * Este metodo sobreescribe el metodo newEloquentBuilder de la clase Model.
     * Esto permite que todos los builders se encapsulen en el archivo ProjectBuilder.php y puedan ser usados por el modelo Project.
     */
    public function newEloquentBuilder($query): ProjectBuilder
    {
        return new ProjectBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
