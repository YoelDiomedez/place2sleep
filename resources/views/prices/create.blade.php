<div id="newPriceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newPriceForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Precio</h4>
                </div>
            @if ($year)
                <div class="modal-body">
                    <input type="hidden" name="period_id" value="{{ $period->id }}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="bold" for="weight">Periodo</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    value="{{ $period->year }}"
                                    readonly
                                    >
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="bold" for="weight">Concepto</label>
                                <input 
                                    type="text" 
                                    name="concept"
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
                        class="btn btn-primary" 
                        id="registrar" 
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Registrando"
                    >
                            Registrar
                    </button>
                </div> 
            @else
                <div class="modal-body">
                    <div class="alert alert-warning text-center">
                        <strong>¡Atenci&oacute;n!</strong>
                        El periodo <b>{{ date('Y') }}</b> debe <a href="{{ url('period') }}">registrarse</a> para agregar nuevos precios.
                    </div>
                </div>
            @endif
            </form>
        </div>
    </div>
</div>