<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formempleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Empleados @if($empleadoSeleccionadoId > 0) Editar @else Crear @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" wire:model.lazy="nombre">
                            @error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Apellido</label>
                            <input type="text" class="form-control" wire:model.lazy="apellido">
                            @error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" wire:model.lazy="usuario">
                            @error('usuario') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Contraseña</label>
                            <input type="text" class="form-control" wire:model.lazy="contrasena">
                            @error('contrasena') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Estado</label>
                            <select name="" id="" class="form-select" wire:model.lazy="estado">
                                <option value="Seleccione" disabled>Seleccione</option>
                                <option value="Habilitado">Habilitado</option>
                                <option value="Deshabilitado">Deshabilitado</option>
                            </select>
                            @error('estado') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Rol</label>
                            <select name="" id="" class="form-select" wire:model.lazy="rol_id">
                                <option value="Seleccione" disabled>Seleccione</option>
                                @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                @endforeach
                            </select>
                            @error('rol_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
                @if($empleadoSeleccionadoId > 0)
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
