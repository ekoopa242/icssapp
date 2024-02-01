<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formusuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Usuario Editar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="limpiar()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" wire:model.lazy="name">
                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Correo electronico</label>
                            <input type="text" class="form-control" wire:model.lazy="email">
                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Contraseña</label>
                            <input type="text" class="form-control" wire:model.lazy="password">
                            @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div> -->
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Rol</label>
                            <select name="" id="" class="form-select" wire:model.lazy="rol">
                                <option value="Seleccione" disabled>Seleccione</option>
                                <option value="Administracion">Administracion</option>
                                <option value="Instalacion">Instalacion</option>
                                <option value="Invitado">Invitado</option>
                            </select>
                            @error('rol') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
                @if($userSeleccionadoId > 0)
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
