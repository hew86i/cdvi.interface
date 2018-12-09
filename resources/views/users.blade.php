<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDVI Interface</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.min.css') }}">

</head>
<body>
    
    <div class="container">
    
        @php

            $users = App\cdviUser::all();

            $groups = App\cdviUserGroup::all();

        @endphp

        {{ $table }}

       

        <hr>

    
    </div>

</body>
</html>