<?php

namespace App\Http\Requests;

use App\Models\Level;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('level_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:levels,name,' . request()->route('level')->id,
            ],
        ];
    }
}
