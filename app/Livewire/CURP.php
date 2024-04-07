<?php

namespace App\Livewire;

use App\Models\Entidades;
use Livewire\Component;

class CURP extends Component
{
    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $entidades = Entidades::all();
        return view('livewire.curp', compact('entidades'));
    }
}
