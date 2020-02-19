@section('styles')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet">
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

@extends('layouts.app')

@section('pagetitle', 'Periodos')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadPeriodDT">@yield('pagetitle')</a>
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
                        <button id="newPeriodBtn" class="btn btn-outline blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="periodDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Año</th>
                            <th>Denominación</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('periods.create')
@include('periods.edit')
@include('periods.delete')

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
        /* Lista de Periodos - Read
        /**************************************************************************/

        const periodDataTable = setUpDataTable('#periodDataTable', 'Lista de Periodos', [0,1,2])

        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadPeriodDT').click( function () {
            periodDataTable.ajax.reload()
        })

         /*************************************************************************/
        /* Agregar Periodo - Create
        /*************************************************************************/
        $('#newPeriodBtn').click( function () {
            setUpFormModal('#newPeriodForm', '#newPeriodModal', 'show')
        })
        
        $('#newPeriodForm').submit( function(event) {
            event.preventDefault()
            addPeriod('#newPeriodForm', '#newPeriodModal', periodDataTable)
        })

        /*************************************************************************/
        /* Editar Periodo - Update
        /*************************************************************************/
        $('#periodDataTable tbody').on('click', '#editPeriodBtn', function(){
            var data = periodDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#updatePeriodForm', '#updatePeriodModal', 'show', data)
        })

        $('#updatePeriodForm').submit(function(e){
            e.preventDefault()
            var id = $('#update').val()
            updatePeriod(id, '#updatePeriodForm', '#updatePeriodModal', periodDataTable)
        })

        /**************************************************************************/
        /* Eliminar Periodo - Delete
        /**************************************************************************/
        $('#periodDataTable tbody').on('click', '#deletePeriodBtn', function(){
            var data = periodDataTable.row($(this).parents('tr')).data()
            setUpFormModal('#deletePeriodForm', '#deletePeriodModal', 'show', data)
        })

        $('#deletePeriodForm').submit(function(e){
            e.preventDefault();
            var id = $('#delete').val()
            deletePeriod(id, '#deletePeriodForm', '#deletePeriodModal', periodDataTable)
        })
    })

    function setUpDataTable(idDataTable, exportTitle, exportColumns) {
        let dataTable = $(idDataTable).DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-circle-o-notch fa-spin"></i> Cargando ',
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: "{{ url('period') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'year', name: 'year'},
                {data: 'appellation', name: 'appellation'},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
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
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: exportTitle
                }, 
                {
                    extend: "excel",
                    className: "btn btn-outline green-meadow",
                    exportOptions: { columns: exportColumns},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: exportTitle
                },
                {
                    extend: "colvis",
                    className: "btn btn-outline purple",
                    text: '<i class="fa fa-th-list"></i>'
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

            $('#year').val(data.year)
            $('#appellation').val(data.appellation)

            $('p').text(data.year)
        }

        $(modal).modal(behavior)
    }

    function addPeriod(form, modal, datatable) {

        $.post('', $(form).serialize()).done(function (data) {
            // console.log(data)
            setUpFormModal(form, modal, 'hide')
            datatable.ajax.reload()
            toastrMessage('success', 'Periodo Registrado')
        })
        .fail(function() {
            toastrMessage('error', 'El Periodo no pudo ser Registrado')
        })
    }

    function updatePeriod(id, form, modal, datatable) {

        $.ajax({
            type: 'PUT',
            url: "{{ url('period') }}" + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#periodDataTable').dataTable().fnFindCellRowIndexes(id, 0)

                datatable.cell(row, 1).data(data.year).draw(false)
                datatable.cell(row, 2).data(data.appellation).draw(false)

                toastrMessage('info', 'Periodo Actualizado')
            },
            error: function(xhr, status) {
                toastrMessage('error', 'El Periodo no pudo ser Actualizado')
            }
        })
    }

    function deletePeriod(id, form, modal, datatable) {

        $.ajax({
            type: 'DELETE',
            url: "{{ url('period') }}" + "/" + id,
            data: $(form).serialize(),
            success: function(data) {
                //console.log(data)
                setUpFormModal(form, modal, 'hide')

                let row = $('#periodDataTable').dataTable().fnFindCellRowIndexes(id, 0)
                datatable.row(row).remove().draw()
                    
                toastrMessage('warning', 'Periodo Eliminado')
            }, 
            error: function(xhr, status) {
                toastrMessage('error', 'El Periodo no pudo ser Eliminado')
            }
        })
    }
    </script>
@endpush