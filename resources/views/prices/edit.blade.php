<div id="updatePriceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updatePriceForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Precio</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="price" id="update">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="bold" for="weight">Concepto</label>
                                <input 
                                    type="text" 
                                    name="concept"
                                    id="concept"
                                    class="form-control" 
                                    maxlength="255" 
                                    required
                                    >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bold" for="weight">Precio (S/)</label>
                                <input 
                                    type="number" 
                                    name="amount"
                                    id="amount"
                                    class="form-control" 
                                    min="0" 
                                    step="0.01"
                                    required
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button 
                        type="submit" 
                        class="btn btn-warning" 
                        id="actualizar"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Actualizando"
                    >
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>