<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description'=>['required','string'],
            'title'=>['required','string'],
            'due_date'=>['required','string', 'date_format:Y-m-d h:i:s'],
            'type'=>['required','string',Rule::in(['to do','in progress','done'])],
            'project_id'=>['nullable'],
            'user_id'=>['nullable','exists:users,id']

        ];
        
       

      
    }
}
