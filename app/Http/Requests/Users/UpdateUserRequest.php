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
            'full_name' => $this->full_name,
            'email_address' => $this->email_address,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'contact_number' => $this->contact_number,
            'postal_code' => $this->postal_code,
            'role_id' =>  $this->role_id,
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
        
    }
}
