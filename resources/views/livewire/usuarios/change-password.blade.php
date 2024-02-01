<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formchangepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
            @endif

            <ul>
                @foreach($users as $user)
                <li>
                    {{ $user->name }}

                    <form wire:submit.prevent="selectUser({{ $user->id }})">
                        @csrf
                        <button type="submit">Cambiar Contraseña</button>
                    </form>
                </li>
                @endforeach
            </ul>

            @if($selectedUserId)
            <form wire:submit.prevent="updatePassword">
                @csrf

                <input type="hidden" wire:model="selectedUserId">

                <div>
                    <label for="currentPassword">Contraseña Actual:</label>
                    <input type="password" wire:model="currentPassword" required>
                    @error('currentPassword') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="newPassword">Nueva Contraseña:</label>
                    <input type="password" wire:model="newPassword" required>
                    @error('newPassword') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="newPasswordConfirmation">Confirmar Nueva Contraseña:</label>
                    <input type="password" wire:model="newPasswordConfirmation" required>
                </div>

                <button type="submit">Cambiar Contraseña</button>
            </form>
            @endif
        </div>
    </div>
</div>
