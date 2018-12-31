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
    <div class="col-sm-1">

    </div>
    <div class="col-sm-11">

        <form id="form"class="form-inline">
        
                <button id="btn_load_data" class="btn btn-info">Освежи</button>
                <button id="btn_update" class="btn btn-info">Пребарај</button> 
                        
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
                    <th>Lokacija</th>
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

    reports_table= $('#reports-table').DataTable({
        dom: 'Blfrtip',
        processing: true,
        serverSide: false,
        select: false,
        // deferLoading: 1,
        // pageLength: 20,
        paging: false,
        // cache : true,
        scrollY: 450,
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ],
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
        // ajax: '{!! route('cdvi.allreports') !!}',
        "ajax": {
            url: '{!! route('cdvi.periodReports') !!}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            "data": function(d){
                d.start_date = start_date;
                d.end_date = end_date;
            }
        },
        'order': [[1, 'desc']],
        columns: [
            { data: 'Event ID', name: 'Event ID', orderable: true, searchable: false},  
            { data: 'Field Time', name: 'Field Time', orderable: true, searchable: false},
            { data: 'UserNameID', name: 'UserNameID', orderable: true, searchable: true},
            { data: 'Card Holder ID', name: 'Card Holder ID', orderable: true, searchable: true},
            { data: 'Record Name ID', name: 'Record Name ID', orderable: true, searchable: true},
        ]       
    });

    $('#btn_load_data').on('click', function (){
        // window.location.reload();
        start_date = "";
        end_date = "";
        $('#reports-table').DataTable().ajax.reload()
        // reports_table.draw();
    })

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

    $('#btn_update').on('click', function(){

        if ($('#start_date input').val() != "" && $('#end_date input').val() != "") {
     
        console.log('Start Date: ' + start_date + ' - End date: ' + end_date)       

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            url: '{!! route('cdvi.periodReports') !!}',
            data: {
                start_date: start_date,
                end_date: end_date,
            },
            success:function(data){
                
                console.log(data) 
                $('#reports-table').DataTable().ajax.reload()

                // start_date = ""
                // end_date = ""

            }
        });

        } else {
            alert('Внесети ги датумите !!!')
        }

    })

       

});

</script>

@endpush
