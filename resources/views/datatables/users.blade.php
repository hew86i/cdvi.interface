@extends('layouts.datatable-master')

@section('content')
    

<h1>- Листа со картички во употреба - </h1>
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

        <div>
            <h4>Вкупно : 
                <span class="fa fa-id-card"></span> 
                <span class="badge badge-dark badge-pill"><font color="green">{{$event->count()}}</font>/{{ App\cdviUser::count() }}</span>
            </h4>
        </div>

        <div class="list-group">

            @foreach ($groups as $group)
                
            <a href="#" id="group_{{$group->ID}}" class="list-cards list-group-item d-flex justify-content-between align-items-center list-group-item-action">

                    <div>
                        <span class="fa fa-id-card"></span>
                        {{ $group->Nom }}                        
                    </div>
                        @php
                        $id = $group->ID;
                        $filter = $event->filter(function ($item) use ($id){
                            if(intval($item->user_info->first()->user_group->UserGroupID) == $id)
                            {
                                return $item;
                            }
                        })
                        @endphp
                    
                    <span class="badge badge-dark badge-pill"><font color="green">{{$filter->count()}}</font>/{{ $group->cdvi_users_count}}</span>
                    
                </a>

            @endforeach

        </div>  


    </div>
    <div class="col-sm-10">

        <form id="form"class="form-inline">
        
                <button id="btn_load_data" class="btn btn-info">Вчитај</button>
                {{-- <button id="btn_selected" class="btn btn-danger">View Selected</button> --}}
                <button id="btn_update" class="btn btn-info">Ажурирај</button> 
        
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
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Картичка Бр.</th>
                    <th>Име Презиме</th>
                    <th>Вид на картичка</th>
                    <th>Почеток</th>
                    <th>Крај</th>
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
  
    var users_table= $('#users-table').DataTable({
        // dom: '<"col-sm-12"B><"col-sm-12"f>t',
        processing: true,
        serverSide: true,
        // select: true,
        // deferLoading: 1,
        // pageLength: 20,
        paging: true,
        // scrollY: 500,
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
        'order': [[2, 'asc']],
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},  
            { data: 'UserID', name: 'UserID', orderable: true, searchable: false},
            { data: 'FirstName', name: 'FirstName' },
            { data: 'LastName', name: 'LastName' },
            { data: 'Groups', name: 'Groups', orderable: true, searchable: true },
            { data: 'StartDate', name: 'StartDate', orderable: true, searchable: false},
            { data: 'EndDate', name: 'EndDate', orderable: true, searchable: false},
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
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Dnevni" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_1').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Detski" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })    
    $('#group_2').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Nedelni" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_3').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Poludnevni" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_4').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Nokni" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_5').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Nedelni Detski" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_6').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Neogranicen Pristap" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })
    $('#group_7').on('click', function(){
        $('.list-cards').css({'background-color' : ''});
        users_table.columns(4).search("^" + "Sezonski" + "$", true, false, true).draw();
        $(this).css('background-color', '#17a2b8');
    })

    //-----------------------------------
    $("form").on('submit',function(e){
        e.preventDefault();
    });

    $('#btn_selected').on('click', function(){

        selected_id = []
        var rows_selected = users_table.column(0).checkboxes.selected();

        $.each(rows_selected, function(index, rowid){
            console.log($(rowid).attr('id'))
        })  

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

        selected_id = [];

        // use checkboxes.js for all pages
        var rows_selected = users_table.column(0).checkboxes.selected();

        $.each(rows_selected, function(index, rowid){
            console.log($(rowid).attr('id'))
            selected_id.push(parseInt($(rowid).attr('id')))
        })
        
        console.log('Start Date: ' + start_date + ' - End date: ' + end_date)

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
                // console.log(data)
                window.location.reload();
                start_date = ""
                end_date = ""

            }
        });

        } else {
            alert('Внесети ги датумите !!!')
        }

    })
       

});

</script>

@endpush
