<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Boolfolio @yield('title')</title>

    <!-- Font Awesome-->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css' integrity='sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==' crossorigin='anonymous'/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header>
            @include('admin.partials.header')
        </header>

        <div class="main-wrapper container-fluid">
            <div class="row h-100">

                @auth

                    <div class="col-2 bg-dark h-100">
                        @include('admin.partials.aside')
                    </div>

                @endauth

                <div class="@auth col-10 @else col-12 @endauth h-100">
                    <main class="h-100 overflow-hidden py-4">
                        @yield('content')
                    </main>
                </div>

            </div>
        </div>

    </div>
</body>

</html>
