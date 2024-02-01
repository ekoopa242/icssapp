<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Clientes @if($clienteSeleccionadoId > 0) Editar @else Crear @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Nombre</label>
                            <input type="text" class="form-control" wire:model.lazy="nombre">
                            @error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Direccion</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" wire:model.lazy="direccion"></textarea>
                            @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Telefono</label>
                            <input type="text" class="form-control" wire:model.lazy="telefono">
                            @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Sexo</label>
                            <select name="" id="" class="form-select" wire:model.lazy="sexo">
                                <option value="Seleccione" disabled>Seleccione</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                            </select>
                            @error('sexo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Codigo de Cliente</label>
                            <select name="" id="" class="form-select" wire:model.lazy="codigoCliente_id">
                                <option value="Seleccione" disabled>Seleccione</option>
                                @foreach ($codigoclientes as $codigocliente)
                                <option value="{{ $codigocliente->id }}">{{ $codigocliente->codigoCliente }}</option>
                                @endforeach
                            </select>
                            @error('codigoCliente_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
                @if($clienteSeleccionadoId > 0)
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
