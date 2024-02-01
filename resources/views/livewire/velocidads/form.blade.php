<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formvelocidads" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cantidad de Velocidad @if($velocidadSeleccionadoId > 0) Editar @else Crear @endif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group mb-3">
              <label for="" class="col-sm-2 col-form-label">Cantidad de Velocidad</label>
              <input type="text" class="form-control" wire:model.lazy="cantVelocidad">
              @error('cantVelocidad') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
        @if($velocidadSeleccionadoId > 0)
            <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
        @else
            <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
        @endif
      </div>
    </div>
  </div>
</div>
