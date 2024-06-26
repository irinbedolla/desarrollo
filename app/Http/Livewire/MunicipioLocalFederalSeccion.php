<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Municipio;
use App\Models\DistritoLocal;
use App\Models\DistritoFederal;
use App\Models\Seccion;

class MunicipioLocalFederalSeccion extends Component
{
    //public $municipioId;
    //public $distritoLocalId;
    //public $distritoFederalId;
    //public $seccionId;

    public $municipios;
    public $distritos_locales;
    public $distritos_federales;
    public $secciones;

    public $municipioSeleccionado = NULL;
    public $distritoLocalSeleccionado = NULL;
    public $distritoFederalSeleccionado = NULL;
    public $seccionSeleccionada = NULL;

    public function mount(){
        $this->municipios = Municipio::all();
        $this->distritos_locales = collect();
        $this->distritos_federales = collect();
        $this->seccion = collect();
        //dd($this);
    }

    public function render()
    {
        return view('livewire.municipio-local-federal-seccion');
    }
}
