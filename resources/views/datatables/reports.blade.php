@extends('layouts.datatable-master')

@section('content')
    

<h1>Извештаи</h1>
<hr>

<style>
.form-inline > * {
    margin-right:15px !important;
    
}
* {
  -webkit-border-radius: 0 !important;
     -moz-border-radius: 0 !important;
          border-radius: 0 !important;
}

</style>

@php

    $groups = App\cdviUserGroup::withCount('cdvi_users')->orderBy('ID', 'asc')->get();

@endphp

<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-10">

        <form id="form"class="form-inline">
        
                <button id="btn_load_data" class="btn btn-info">Вчитај</button>
                {{-- <button id="btn_selected" class="btn btn-danger">View Selected</button> --}}
                        
            <div class="form-group">
        
                    <div class="input-group date" id="start_date" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Почеток</span>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#start_date"/>
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <span>&nbsp;-&nbsp;</span>
                    <div class="input-group date" id="end_date" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Крај</span>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#end_date"/>
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
        
        </form>
        <hr>
        <table class="table table-bordered" id="reports-table">
            <thead>
                <tr>
                    <th>EventID</th>
                    <th>Time</th>
                    <th>User ID</th>
                    <th>Card ID</th>
                </tr>
            </thead>
            </table>

    </div>
</div>


@endsection

@push('scripts')

<script>

$(function() {

    // global vars
    selected_id = [];
    start_date = "";
    end_date = "";
  
    var users_table= $('#reports-table').DataTable({
        dom: '<"col-sm-12"B><"col-sm-12"f>t',
        processing: true,
        serverSide: true,
        select: true,
        // deferLoading: 1,
        // pageLength: 20,
        paging: false,
        scrollY: 500,
        language: {
            "info": "Прикажани _TOTAL_ записи", 
            "sProcessing": "Процесирање...",
            "sLengthMenu": "Прикажи _MENU_ записи",
            "sZeroRecords": "Не се пронајдени записи",
            "sEmptyTable": "Нема податоци во табелата",
            "sLoadingRecords": "Вчитување...",
            "sInfoEmpty": "Прикажани 0 до 0 од 0 записи",
            "sInfoFiltered": "(филтрирано од вкупно _MAX_ записи)",
            "sInfoPostFix": "",
            // "sSearch": "Барај",
            "sSearch": "<i class='fa fa-search'></i>",
            // "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Macedonian.json",
        },
        ajax: '{!! route('cdvi.allreports') !!}',
        select: {
            'style': 'multi'
        },
        'order': [[1, 'desc']],
        columns: [
            { data: 'Event ID', name: 'Event ID', orderable: true, searchable: false},  
            { data: 'Field Time', name: 'Field Time', orderable: true, searchable: false},
            { data: 'UserNameID', name: 'UserNameID', orderable: true, searchable: true},
            { data: 'Card Holder ID', name: 'Card Holder ID', orderable: true, searchable: true},
        ]       
    });

    // $('#btn_load_data').on('click', function (){
    //     window.location.reload();
    //     users_table.ajax.url('{!! route('cdvi.allreports') !!}').load();
    //     users_table.draw();
    // })

    //-----------------------------------
    $("form").on('submit',function(e){
        e.preventDefault();
    });

    // set the datetime pickers
    $('#start_date').datetimepicker({
        locale: 'mk',
        icons: {
                time: 'far fa-clock',
        }
    });
    $('#end_date').datetimepicker({
        useCurrent: false,
        locale: 'mk',
        icons: {
                time: 'far fa-clock',
        }
    });
    // listen to change event
    $("#start_date").on("change.datetimepicker", function (e) {
        $('#end_date').datetimepicker('minDate', e.date);
        start_date = String(moment($('#start_date').datetimepicker('viewDate')).format('YYYY-MM-DD HH:mm')) + ":00"
    });
    $("#end_date").on("change.datetimepicker", function (e) {
        $('#start_date').datetimepicker('maxDate', e.date);
        end_date = String(moment($('#end_date').datetimepicker('viewDate')).format('YYYY-MM-DD HH:mm')) + ":00"
    });

       

});

</script>

@endpush
