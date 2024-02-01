<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $users;
    public $selectedUserId;
    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirmation;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.change-password');
    }

    public function updatePassword()
    {
        // Validar la solicitud
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        // Verificar la contraseña actual
        if (!Hash::check($this->currentPassword, auth()->user()->password)) {
            $this->addError('currentPassword', 'La contraseña actual es incorrecta.');
            return;
        }

        // Obtener el usuario
        $user = User::find($this->selectedUserId);

        // Actualizar la contraseña
        $user->update(['password' => bcrypt($this->newPassword)]);

        // Limpiar los campos del formulario
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';

        session()->flash('success', 'Contraseña actualizada correctamente.');
    }
}
