<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Usuarios extends Component
{
    public $userSeleccionadoId;
    public $name, $email, $password, $rol;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'rol' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'name.required' => 'El campo no puede estar vacio',
        'email.required' => 'El campo no puede estar vacio',
        'password.required' => 'El campo no puede estar vacio',
        'rol.not_in' => 'Debe seleccionar un rol'
    ];

    public function mount(){
        $this->rol = "Seleccione";
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.usuarios.index', compact('users'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->name=null;
        $this->email=null;
        $this->password=null;
        $this->rol='Seleccione';
        $this->userSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit(User $user){
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->rol = $user->rol;

        $this->userSeleccionadoId = $user->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $user = User::find($this->userSeleccionadoId);
        $this->validate();
        try {
            $user->update([
                "name" => $this->name,
                "email" => $this->email,
                "password" => $this->password,
                "rol" => $this->rol
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(User $user){
        try {
            $user->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}
