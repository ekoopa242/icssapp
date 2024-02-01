<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $conteo = 0;
    public function render()
    {
        return view('livewire.test')
        ->extends('layouts.app')
        ->section('content');
    }

    public function aumentarConteo(){
        $this->conteo++;
    }

    public function reducirConteo(){
        $this->conteo--;
    }
}
