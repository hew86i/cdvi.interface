<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datatable - CDVI USERS</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/select.dataTables.min.css')}}">
    
    {{-- datepicker for bootstrap4 --}}        
    <link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.min.css')}}">
    
    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}
    
</head>
<body>
    
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 navbar-expand-md">
        {{-- <div class="navbar-brand d-flex align-items-center justify-content-between col-sm-12 col-md-2 mr-0">
                <img src="{{ asset('/images/ELEM-logo-164.png') }}" width="90" height="40" class="d-inline-block align-top" alt="">
                   ELEM
            <span class="navbar-text">
        </div>

        <span class="navbar-text">
               <h3>СКИ Центар Попова Шапка</h3> 
        </span> --}}

        <a class="navbar-brand" href="#">
            <img src="{{ asset('/images/ELEM-logo-164.png') }}" width="90" height="40" class="d-inline-block align-top" alt="">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Картички <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/reports') }}">Извештај</a>
            </li>
        </ul>

    </nav>
    
    <div class="container-fluid">
        @yield('content')
    </div>
    
    
    {{-- jQuery 3 3.3.1, DataTables 1.10.18 --}}
    <script src="{{ asset('/js/datatables.min.js') }}"></script> 
    <script src="{{ asset('/js/dataTables.select.min.js') }}"></script> 

    {{-- bootstrap.js --}}
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script> 
    {{-- <script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>  --}}
    <script src="{{ asset('/js/dataTables.checkboxes.min.js') }}"></script> 
    <script src="{{ asset('/js/moment-with-locales.min.js') }}"></script> 
    
    {{-- buttons --}}
    <script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script> 
    <script src="{{ asset('/js/buttons.html5.min.js') }}"></script> 
    <script src="{{ asset('/js/jszip.min.js') }}"></script> 
    <script src="{{ asset('/js/pdfmake.min.js') }}"></script> 
    <script src="{{ asset('/js/vfs_fonts.js') }}"></script> 
        
    <script src="{{ asset('/js/tempusdominus-bootstrap-4.min.js') }}"></script> 


    @stack('scripts')

</body>
</html>


