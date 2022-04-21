<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;

class Customerpage extends Component
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
        return view('livewire.customers.customerpage');
    }
}
