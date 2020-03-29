<div id="newNicheModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newNicheForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Nicho</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Pabellón</label>
                                <select 
                                    id="newPavilion" 
                                    name="pavilion_id" 
                                    class="form-control" 
                                    required></select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Fila</label>
                                <select name="row_x" class="form-control" required>
                                    <option value="" disabled selected>Seleccione una Fila</option>
                                    <option>A</option><option>B</option><option>C</option>
                                    <option>D</option><option>E</option><option>F</option>
                                    <option>G</option><option>H</option><option>I</option>
                                    <option>J</option><option>K</option><option>L</option>
                                    <option>M</option><option>N</option>
                                    <option>O</option><option>P</option><option>Q</option>
                                    <option>R</option><option>S</option><option>T</option>
                                    <option>U</option><option>V</option><option>W</option>
                                    <option>X</option><option>Y</option><option>Z</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Categoria</label>
                                <select name="category" class="form-control" required>
                                    <option value="" disabled selected>Seleccione una Categoria</option>
                                    <option value="A">Adulto</option>
                                    <option value="P">Parvulo</option>
                                    <option value="O">Osario</option>
                                    <option value="D">Dorado</option>
                                    <option value="Z">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Columna</label>
                                <input 
                                    type="number" 
                                    name="col_y" 
                                    class="form-control" 
                                    step="1"
                                    min="1"
                                    max="99"
                                    required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Estado</label>
                                <select name="state" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un Estado</option>
                                    <option value="D">Disponible</option>
                                    <option value="T">Tramite</option>
                                    <option value="O">Ocupado</option>
                                    <option value="R">Reservado</option>
                                    <option value="Z">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Precio</label>
                                <input 
                                    type="number" 
                                    name="price" 
                                    class="form-control" 
                                    step="0.01"
                                    min="0"
                                    max="999999.99"
                                    required>
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
            </form>
        </div>
    </div>
</div>