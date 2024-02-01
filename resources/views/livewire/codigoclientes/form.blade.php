<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formCodigoclientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Codigo de Cliente @if($codigoclienteSeleccionadoId > 0) Editar @else Crear @endif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="limpiar()"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="form-group mb-3">
              <label for="" class="col-sm-2 col-form-label">Codigo del cliente</label>
              <input type="text" class="form-control" wire:model.lazy="codigoCliente">
              @error('codigoCliente') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
              <label for="" class="col-sm-2 col-form-label">Lugar</label>
              <select name="" id="" class="form-select" wire:model.lazy="lugar">
                <option value="Seleccione" disabled>Seleccione</option>
                <option value="SRC">SRC</option>
                <option value="Cucuyagua">Cucuyagua</option>
                <option value="La Union">La Union</option>
                <option value="Corpus">Corpus</option>
              </select>
              @error('lugar') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
              <label for="" class="col-sm-2 col-form-label">Estado</label>
              <select name="" id="" class="form-select" wire:model.lazy="estado">
                <option value="Seleccione" disabled>Seleccione</option>
                <option value="Habilitado">Habilitado</option>
                <option value="Ocupado">Ocupado</option>
              </select>
              @error('estado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
        @if($codigoclienteSeleccionadoId > 0)
            <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
        @else
            <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
        @endif
      </div>
    </div>
  </div>
</div>
