<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CDVI Interface</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container">
    
        @php

            $users = App\cdviUser::all();

            $groups = App\cdviUserGroup::all();

        @endphp

        {{ $table }}

        {{-- @foreach ($groups as $group)
            
            <h1>Корисничка Група: {{ $group->Name }}</h1>

            @foreach ($group->cdvi_users as $item)

                <ul>
                    <li><b>UserID:</b> {{ $item->UserID }}: {{$item->FirstName}} | StartDate: {{$item->StartDate}} | EndDate: {{$item->EndDate}} | Cards: {{ $item->cdvi_cards->pluck('CardNumHex') }}</li>
                </ul>
                
            @endforeach

        @endforeach --}}

        

        <hr>
{{-- 
        @php

            $cards = DB::connection('sqlsrv')->select('select * from Cards');

        @endphp     

        <h1>Cards: </h1>
    
        @foreach ($cards as $item)
        
            <ul>
            <li>{{ $item->{'Family Number'} }}:{{ $item->{'Card Number'} }} UserID: {{ $item->UserID}}</li>
            </ul>

        @endforeach --}}
    
    </div>

</body>
</html>