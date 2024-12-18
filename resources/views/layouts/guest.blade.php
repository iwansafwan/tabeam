<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('web_image/logo.png') }}" type="image/png">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <title>{{ config('app.name', 'TABEAM') }}</title>

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


        <!-- jQuery (required for Toastr) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        
        <style>

            .input-icon {
                position: relative; /* Positioning context for the icon */
                border-bottom: 1px solid rgba(0,0,0,0.3);
            }

            .input-icon i {
                position: absolute; /* Positioning the icon */
                left: 10px; /* Space from the left */
                top: 50%; /* Center vertically */
                transform: translateY(-50%); /* Adjust vertical alignment */
                color: gray; /* Icon color */
            }
            
            .border-bottom-input {
                border: none; /* Remove all borders */
                /* border-bottom: 1px solid black; */
                width: 100%; /* Full width */
                outline: none; /* Remove outline on focus */
                padding-left: 40px; /* Space for the icon */
            }

            .border-bottom-input:focus {
                border-bottom: 1px solid #de3a39; /* Optional: change border color on focus */
            }
            
        </style>

    </head>
    <body>
        <div class="container-fluid">
            <!-- Toastr Success Message -->
            @if(session('success'))
                <script>
                    toastr.success('{{ session('success') }}', 'Success', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 5000
                    });
                </script>
            @endif
            <!-- Toastr Error Message -->
            @if(session('error'))
                <script>
                    toastr.error('{{ session('error') }}', 'Failed', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 5000
                    });
                </script>
            @endif
            <div class="row justify-content-center" style="margin-top:50px !important;">
                <div class="col-md-4 col-4 text-center">
                    <a href="/" class="btn">
                        <img src="{{asset('web_image/logo.png')}}" alt="" style="width:200px !important; height: auto !important;">
                    </a>
                </div>
            </div>

            <div class="row justify-content-center" style="margin-bottom:50px !important;">
                <div class="col-md-4 col-10">
                    {{ $slot }}
                </div>
            </div>
        </div>


        <!-- Bootstrap 5 JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    </body>
</html>
