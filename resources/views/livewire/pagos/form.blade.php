<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formpagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pago</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="limpiar()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Monto a pagar</label>
                            <input type="text" class="form-control" wire:model.lazy="montopagado">
                            @error('montopagado') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Estado</label>
                            <select name="" id="" class="form-select" wire:model.lazy="estado">
                                <option value="Seleccione" disabled>Seleccione</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Pagado">Pagado</option>
                                <option value="Debe">Debe</option>
                            </select>
                            @error('estado') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Tipo de Pago</label>
                            <select name="" id="" class="form-select" wire:model.lazy="tipopago">
                                <option value="Seleccione">Seleccione</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Transferencia ACH">Transferencia ACH</option>
                            </select>
                            @error('tipopago') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">Comentario</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" wire:model.lazy="comentario"></textarea>
                            @error('comentario') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
            </div>
        </div>
    </div>
</div>
