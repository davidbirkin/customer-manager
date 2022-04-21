<?php

namespace App\Http\Livewire\Invoices;

use Livewire\Component;

class Invoicepage extends Component
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
        return view('livewire.invoices.invoicepage');
    }
}
