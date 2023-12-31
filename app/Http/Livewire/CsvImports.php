<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class CsvImports extends Component
{

    public string $model;

    protected $listeners = [
        'imports.refresh'=>'$refresh'
    ];

    public function getImportsProperty(): Collection {
        return auth()->user()->imports()->oldest()->forModel($this->model)->notCompleted()->get();
    }



    public function render()
    {
        return view('livewire.csv-imports');
    }
}
