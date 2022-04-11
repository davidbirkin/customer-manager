<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class AddNewRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

     protected function prepareForValidation()
    {
        $data = json_decode($this->content);

        ray($data);

        $this->merge([
            'name' =>  $data->role_name,
        ]);
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|string|unique:roles,name"
        ];
    }
}
