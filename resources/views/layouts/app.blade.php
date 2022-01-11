<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
        <meta id="user-id" value="test" name="user-id" content="{{ Auth::user()->name }}">

        <!-- Css -->
        <link rel="stylesheet" href="{{ url('assets/admin/css/styles.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/css/all.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/css/toastr.min.css') }}">

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">    
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body >
    
    <div class="mx-auto bg-grey-400">
    <!--Screen-->
        <div class="min-h-screen flex flex-col">
            {{ $slot }}
    
</div>    
</div>    
          {{--
          
          <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            
            <main>
                {{ $slot }}
            </main>
        </div>
        --}}
    </body>
</html>
