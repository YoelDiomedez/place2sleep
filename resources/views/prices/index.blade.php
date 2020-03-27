@section('styles')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet">
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

@extends('layouts.app')

@section('pagetitle', 'Precios')
@section('pagesubtitle', auth()->user()->cemetery_appellation.date(' Y'))

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadPriceDT">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Lista</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-4 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                        <button id="newPriceBtn" class="btn btn-outline blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="priceDataTable" class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th>Monto (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('prices.create')
@include('prices.edit')
@include('prices.delete')

@endsection

@push('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/fnFindCellRowIndexes.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista - Read
        /**************************************************************************/
        const priceDataTable = setUpDataTable(
            '#priceDataTable', 
            'Lista de Precios', 
            [ 0, 1, 2],
            [],
            [
                {data: 'id', name: 'id'},
                {data: 'concept', name: 'concept'},
                {data: 'amount', name: 'amount'},
                {data: 'buttons', orderable: false, className: "text-center btn-actions"},
            ]
        )

        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadPriceDT').click( function () {
            priceDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Agregar - Create
        /*************************************************************************/
        $('#newPriceBtn').click( function () {
            setUpFormModal('#newPriceForm', '#newPriceModal', 'show')
        })
        
        $('#newPriceForm').submit( function(event) {
            event.preventDefault()
            addPrice('#newPriceForm', '#newPriceModal', priceDataTable) 
        })

        /*************************************************************************/
        /* Editar - Update
        /*************************************************************************/
        $('#priceDataTable tbody').on('click', '#editPriceBtn', function(){
            let data = priceDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#updatePriceForm', '#updatePriceModal', 'show', data)
        })

        $('#updatePriceForm').submit( function(event) {
            event.preventDefault()
            updatePrice(
                $('#update').val(), 
                '#updatePriceForm', 
                '#updatePriceModal', 
                priceDataTable
            )
        })

        /**************************************************************************/
        /* Eliminar - Delete
        /**************************************************************************/
        $('#priceDataTable tbody').on('click', '#deletePriceBtn', function(){
            let data = priceDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deletePriceForm', '#deletePriceModal', 'show', data)
        })

        $('#deletePriceForm').submit( function(event) {
            event.preventDefault()
            deletePrice(
                $('#delete').val(), 
                '#deletePriceForm', 
                '#deletePriceModal', 
                priceDataTable
            )
        })
    })

    const url = "{{ url('price') }}"

    function setUpDataTable(id, exportTitle, exportColumns, columnDefs, columns) {
        let dataTable = $(id).DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando '
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: url,
            columns: columns,
            columnDefs: columnDefs,
            buttons: [
                {
                    extend: "print",
                    className: "btn btn-outline dark",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: exportTitle
                }, 
                {
                    extend: "pdf",
                    className: "btn btn-outline red",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'Exportar PDF',
                    title: exportTitle
                }, 
                {
                    extend: "excel",
                    className: "btn btn-outline green-meadow",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Exportar Excel',
                    title: exportTitle
                },
                {
                    extend: "colvis",
                    className: "btn btn-outline purple",
                    text: '<i class="fa fa-th-list"></i> Columnas'
                }
            ],
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        })

        return dataTable
    }

    function setUpFormModal(form, modal, behavior, data = false) {

        $(form)[0].reset()

        if (data) {
            // console.log(data)
            $('#update').val(data.id)
            $('#delete').val(data.id)

            $('#concept').val(data.concept)
            $('#amount').val(data.amount)

            $('p').text(data.concept +' - S/ '+ data.amount)
        }

        $(modal).modal(behavior)
    }

    function addPrice(form, modal, dataTable) {

        loading('#registrar', 'start')

        $.ajax({
            type: 'POST',
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                dataTable.ajax.reload()

                toastrMessage('success', 'Precio Registrado')
                loading('#registrar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Precio no pudo ser Registrado')
                loading('#registrar', 'stop')
            }
        })
    }

    function updatePrice(id, form, modal, dataTable) {

        loading('#actualizar', 'start')

        $.ajax({
            type: 'PUT',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#priceDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                dataTable.cell(row, 1).data(data.concept).draw(false)
                dataTable.cell(row, 2).data(data.amount).draw(false)

                toastrMessage('info', 'Precio Actualizado')
                loading('#actualizar', 'stop')
            },
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Precio no pudo ser Actualizado')
                loading('#actualizar', 'stop')
            }
        })
    }

    function deletePrice(id, form, modal, dataTable) {

        loading('#eliminar', 'start')

        $.ajax({
            type: 'DELETE',
            url: url + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#priceDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                dataTable.row(row).remove().draw()
                    
                toastrMessage('warning', 'Precio Eliminado')
                loading('#eliminar', 'stop')

            }, 
            error: function(xhr, status) {
                // console.log(xhr.responseJSON.message)
                toastrMessage(status, 'El Precio no pudo ser Eliminado')
                loading('#eliminar', 'stop')
            }
        })
    }
    </script>
@endpush