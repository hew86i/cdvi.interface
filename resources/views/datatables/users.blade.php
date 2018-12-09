@extends('layouts.datatable-master')

@section('content')
    

<h1>Листиг на Корисници</h1>
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

    $groups = App\cdviUserGroup::withCount('cdvi_users')->get();

@endphp

<div class="row">
    <div class="col-sm-2">

        <div class="list-group">

            @foreach ($groups as $group)
                
            <a href="#" id="group_{{$group->ID}}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">

                    <div>
                        <span class="fa fa-id-card"></span>
                        {{ $group->Nom }}
                    </div>
                    
                    <span class="badge badge-dark badge-pill">{{ $group->cdvi_users_count}}</span>
                    
                </a>

            @endforeach

        </div>  


    </div>
    <div class="col-sm-10">

        <form id="form"class="form-inline">
        
                <button id="btn_load_data" class="btn btn-info">Вчитај</button>
                <button id="btn_selected" class="btn btn-danger">View Selected</button>
                <button id="btn_update" class="btn btn-info">Ажурирај</button> 
        
            <div class="form-group">
        
                    <div class="input-group date" id="start_date" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Start Date</span>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#start_date"/>
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <span>&nbsp;-&nbsp;</span>
                    <div class="input-group date" id="end_date" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <span class="input-group-text">End Date</span>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#end_date"/>
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
        
        </form>
        <hr>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th></th>
                    <th>UserID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Group</th>
                    <th>Start Date</th>
                    <th>End Date</th>
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
  
    var users_table= $('#users-table').DataTable({
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
        ajax: '{!! route('cdvi.allusers') !!}',
        columnDefs: [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        select: {
            'style': 'multi'
        },
        'order': [[1, 'asc']],
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},  
            { data: 'UserID', name: 'UserID' },
            { data: 'FirstName', name: 'FirstName' },
            { data: 'LastName', name: 'LastName' },
            { data: 'Groups', name: 'Groups', orderable: true, searchable: true },
            { data: 'StartDate', name: 'StartDate' },
            { data: 'EndDate', name: 'EndDate' }
        ]       
    });

    $('#btn_load_data').on('click', function (){
        window.location.reload();
        users_table.ajax.url('{!! route('cdvi.allusers') !!}').load();
        users_table.draw();
    })
// group list envents
    // -----------------------------------
    $('#group_0').on('click', function(){
        users_table.columns(4).search("^" + "Ednodnevni" + "$", true, false, true).draw();
    })
    $('#group_1').on('click', function(){
        users_table.columns(4).search("^" + "Detski" + "$", true, false, true).draw();
    })    
    $('#group_2').on('click', function(){
        users_table.columns(4).search("^" + "Nedelni" + "$", true, false, true).draw();
    })
    $('#group_3').on('click', function(){
        users_table.columns(4).search("^" + "Poludnevni" + "$", true, false, true).draw();
    })
    $('#group_4').on('click', function(){
        users_table.columns(4).search("^" + "Nokni" + "$", true, false, true).draw();
    })
    $('#group_5').on('click', function(){
        users_table.columns(4).search("^" + "Nedelni Detski" + "$", true, false, true).draw();
    })
    $('#group_6').on('click', function(){
        users_table.columns(4).search("^" + "Neogranicen Pristap" + "$", true, false, true).draw();
    })

    //-----------------------------------
    $("form").on('submit',function(e){
        e.preventDefault();
        //ajax code here
    });

    $('#btn_selected').on('click', function(){

        selected_id = []
        var rows_selected = users_table.column(0).checkboxes.selected();

        $.each(rows_selected, function(index, rowid){
            console.log($(rowid).attr('id'))
        })
  
        $('#users-table').find('input[type="checkbox"]:checked').each(function () {

            // var rows_selected = users_table.column(0).checkboxes.selected();

            // var $row = $(this).closest('tr');

            // Get row data
            // var data = users_table.row($row).data();
            // console.log(data)
            // selected_id.push(parseInt(data["UserID"]))            


        });
        // console.log($(rows_selected[0]).attr('id'));

    })
    

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
    $("#start_date").on("change.datetimepicker", function (e) {
        $('#end_date').datetimepicker('minDate', e.date);
    });
    $("#end_date").on("change.datetimepicker", function (e) {
        $('#start_date').datetimepicker('maxDate', e.date);
    });

    $('#btn_update').on('click', function(){
        
        if ($('#start_date input').val() != "" && $('#end_date input').val() != "") {

        selected_id = [];

        // use checkboxes.js for all pages
        var rows_selected = users_table.column(0).checkboxes.selected();

        $.each(rows_selected, function(index, rowid){
            console.log($(rowid).attr('id'))
            selected_id.push(parseInt($(rowid).attr('id')))
        })
        
        // $('#users-table').find('input[type="checkbox"]:checked').each(function () {
        //     // var row = $(this);
        //     // selected_id.push(parseInt(row.attr('id')))  

            

        //     var $row = $(this).closest('tr');

        //     // Get row data
        //     var data = users_table.row($row).data();
 
        //     selected_id.push(parseInt(data["UserID"]))                

        // });

        console.log('before send:')
        console.log(selected_id)

        // fix for sql query
        // datetime picker gives value for secounds larger than 60!!!
        // ------------------------------------------------------------
        var start_date = String(moment($('#start_date').datetimepicker('viewDate')).format('YYYY-MM-DD HH:MM'))
        start_date = start_date + ":00";
        var end_date = String(moment($('#end_date').datetimepicker('viewDate')).format('YYYY-MM-DD HH:MM'))
        end_date = end_date + ":00";
        // --------------------------------------------------------------


        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{!! route('cdvi.updateDates') !!}',
            data: { id: selected_id,
                start_date: start_date,
                end_date: end_date,
            },
            success:function(data){
                console.log(data)
                window.location.reload();

            }
        });

        } else {
            alert('Внесети ги датумите !!!')
        }

    })
       

});

</script>

@endpush