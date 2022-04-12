<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;

class RoleTable extends Component
{

    protected function rules()
    {
        $rules = [

        ];
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.roles.role-table');
    }
}
