<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Datos as DatosModel;

class CURP extends Component
{
    use WithPagination;

    public $searchClave = '';
    public $searchNombre = '';
    public $searchCorreo = '';
    public $searchTelefono = '';
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    }

    public function buscar()
    {
        $this->resetPage();
    }

    public function limpiar()
    {
        $this->searchClave = '';
        $this->searchNombre = '';
        $this->searchCorreo = '';
        $this->searchTelefono = '';
        $this->resetPage(); // Opcional, para restablecer la paginación a la página 1
    }

    public function render()
    {
        $query = DatosModel::query();

        if ($this->searchClave) {
            $query->where('clave', 'like', '%' . trim($this->searchClave) . '%');
        }
        if ($this->searchNombre) {
            $query->where('nombre', 'like', '%' . trim($this->searchNombre) . '%');
        }
        if ($this->searchCorreo) {
            $query->where('correo', 'like', '%' . trim($this->searchCorreo) . '%');
        }
        if ($this->searchTelefono) {
            $query->where('telefono', 'like', '%' . trim($this->searchTelefono) . '%');
        }

        return view('livewire.curp', [
            'datos' => $query->paginate(10),
        ]);
    }
}
