<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bhitai</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/all.css" type="text/css" media="all">    
        <script src="https://unpkg.com/vue-multiselect@2.1.0"></script> 
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
        <!-- Styles -->

    </head>
    <body>
    @if (session()->has('user_exist'))
        <script>
            window.Laravel = {!!json_encode([
                'isLoggedin' => true,
            ])!!}
        </script>
    @else
        <script>
            window.Laravel = {!!json_encode([
                'isLoggedin' => false
            ])!!}
        </script>
    @endif

        <div id="app">
                        
        </div>
            
    </body>
</html>

<script src="{{ mix('js/app.js')}}"></script>



