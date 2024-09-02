<?php

namespace App\Http\Requests;

use App\Models\Notice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNoticeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('notice_create');
    }

    public function rules()
    {
        return [
            'author_id' => [
                'required',
                'integer',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'message' => [
                'required',
            ],
        ];
    }
}
