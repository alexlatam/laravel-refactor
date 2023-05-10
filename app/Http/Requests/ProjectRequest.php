<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:140',
                // Ignorara al project quye venga en la peticion, esto validara el nombre del proyecto que se esta editando
                Rule::unique('projects', 'name')->ignore(request('project')),
            ],
            'description' => 'nullable|string|min:10'
        ];
    }
}
