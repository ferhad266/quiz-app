<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:200',
            'description' => 'max:1000|min:1',
            'finished_at' => 'nullable|after:' . now()
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Quiz title',
            'description' => 'Quiz description',
            'finished_at' => 'Finish time'
        ];
    }
}
