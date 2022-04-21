<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;

class Transactionspage extends Component
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
        return view('livewire.transactions.transactionspage');
    }
}
