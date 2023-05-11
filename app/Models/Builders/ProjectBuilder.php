<?php
namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

final class ProjectBuilder extends Builder
{
    // Metodo para obetener los Projectos del usuario actual (usuario autenticado)
    public function forCurrentUser(): Builder
    {
        return $this->where('user_id', auth()->id());
    }

    // Metodo para obetener los Projectos con status activo
    public function isActive(): Builder
    {
        return $this->where('status', 'avitve');
    }
}
