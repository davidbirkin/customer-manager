<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        $this->merge([
            'full_name' => $data->full_name,
            'email_address' => $data->email_address,
            'address_line_1' => $data->address_line_1,
            'address_line_2' => $data->address_line_2,
            'contact_number' => $data->contact_number,
            'postal_code' => $data->postal_code,
            'role_id' =>  $data->role_id,
        ]);
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = json_decode($this->content);
        $user = User::find($data->id);

        return [
            'full_name' => 'required|string|max:100', 
            'email_address' => 'required|email|'. Rule::unique('users', 'email_address')->ignore($user->id),
            'address_line_1' => 'nullable|string|max:100',
            'address_line_2' => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|regex:/^\(\d{3}\).*?([0-9]{3}).*?([0-9]{4})/',
            'postal_code' => 'nullable|string|max:10',
            'role_id' => 'nullable|integer|min:1'
        ];
    }
}
