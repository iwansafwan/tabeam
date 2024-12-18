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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            
            body{
                font-family: Arial, Helvetica, sans-serif !important;
                background-color:#01ad9d !important;
            }

            .btn_menu{
                font-size:16pt !important;
                margin-left:15px !important;
                margin-right:15px !important;
                background-color:#01ad9d !important;
                min-width:180px !important;
                box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3); /* Add drop shadow */
                transition: box-shadow 0.3s ease; 
                color:white !important;
            }

            .btn_menu:hover{
                font-size:16pt !important;
                margin-left:15px !important;
                margin-right:15px !important;
                background-color:#33f9a7 !important;
                font-weight:bold !important;
                box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.5); /* Stronger shadow on hover */
                color:black !important;
            }

            .btn_menu.btn_active{
                font-size:16pt !important;
                margin-left:15px !important;
                margin-right:15px !important;
                font-weight:bold !important;
                background-color:#33f9a7 !important;
                color:black !important;
            }

            .gradient-text {
                background: linear-gradient(90deg, #33f9a7, #01ad9d);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                font-weight:bold !important;
            }

            .no-toggle-icon::after {
                display: none !important;
            }

        
            .sidebar {
                background-color: #f8f9fa; /* Light background for sidebar */
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                transition: width 0.3s;
                width:80px !important;
                min-height:100vh !important;
                position:fixed !important;
            }

            .sidebar a {
                display: flex;
                align-items: center;
                padding: 15px; /* Spacing */
                color: black; /* Icon color */
                text-decoration: none; /* No underline */
                font-size: 30px !important; /* Icon size */
                justify-content:center !important;
                margin-top:10px;
                margin-bottom:10px;
            }

            .sidebar a.active {
                background-color: #01ad9d !important; /* Hover effect */
                color:white !important;
                border-radius:10px;
            }

            .sidebar a:hover {
                background-color: #e9ecef; /* Hover effect */
            }

            .title_header{
                font-size:24pt !important;
                font-weight:bold !important;
                color:white !important;
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
            @if(!Auth::check())
                @include('layouts.navigation')
            @endif
            <div class="row">
                @if(Auth::check())
                    @include('layouts.leftbar')
                @endif
                <div class="col-auto flex-grow-1" style="padding-left:100px !important;">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>

        </div>
        

        <!-- Bootstrap 5 JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script>

            $(document).ready(function() {
                // Call update_event_time_status via AJAX
                $.ajax({
                    url: "{{ route('funds.update_fund_status') }}",
                    type: "GET",
                    success: function(response) {
                        // Show a success message using Toastr or log it to the console
                        // toastr.success(response.message, 'Success');
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        // Handle error, checking for the error message in xhr response
                        let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Failed to update fund statuses';
                        
                        // Use Toastr to display the error message or log it to the console
                        // toastr.error(errorMessage, 'Error');
                        console.log(errorMessage);
                    }
                });

                @if (Auth::user()->roles()->where('name', 'admin')->exists())
                
                    // Call check general qr code via AJAX
                    $.ajax({
                        url: "{{ route('general_funds.check_general_qrcode') }}",
                        type: "GET",
                        success: function(response) {
                            // Show a success message using Toastr or log it to the console
                            // toastr.success(response.message, 'Success');
                            console.log(response.message);
                        },
                        error: function(xhr) {
                            // Handle error, checking for the error message in xhr response
                            let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Failed to update fund statuses';
                            
                            // Use Toastr to display the error message or log it to the console
                            // toastr.error(errorMessage, 'Error');
                            console.log(errorMessage);
                        }
                    });

                @endif

            });

        </script>

    </body>
</html>
