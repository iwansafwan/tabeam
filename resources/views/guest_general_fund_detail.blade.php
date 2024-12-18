<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            
            body{
                font-family: Arial, Helvetica, sans-serif !important;
                background-color:#01ad9d !important;
            }

            .menu_btn{
                min-width:150px !important;
                padding:20px 0px 20px 0px !important;
                background-color:#01ad9d !important;
                color:black !important;
                border-radius:15px !important;
                margin:0px 20px 0px 20px !important;
                font-size:14pt !important;
                text-align:center !important;
            }

            .menu_btn:hover{
                max-width:200px !important;
                padding:20px 0px 20px 0px !important;
                background-color:#01ad9d !important;
                color:black !important;
                border-radius:15px !important;
                margin:0px 20px 0px 20px !important;
                font-size:14pt !important;
                font-weight:bold !important;
            }

            .title_header{
                font-size:24pt !important;
                font-weight:bold !important;
                color:white !important;
            }

            .fund_goal{
                font-size:24pt !important;
                font-weight:bold !important;
            }

            .custom-left-border{
                border-left:2px solid #dddddd !important;
            }

            /* For mobile view (full-width columns) */
            @media (max-width: 767px) {

                .custom-left-border{
                    border-left:none !important;
                    border-top:2px solid #dddddd !important;
                    margin-top:20px !important;
                    padding-top:20px !important;
                }
            }

        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center shadow" style="background-color:white !important; margin-bottom:50px !important;">
                <div class="col-md-5 col-6">
                    <a href="/" class="btn">
                        <img src="{{asset('web_image/logo.png')}}" alt="" style="width:100px !important; height: auto !important;">
                    </a>
                </div>
                <div class="col-md-5 col-6 d-flex align-items-center justify-content-end">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="menu_btn shadow">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="menu_btn shadow">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="menu_btn shadow">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <span class="title_header">General Fund Details</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mx-0 my-3">
                                <div class="col-md-5 col-12">
                                    <div class="display_box_2">
                                        <img src="{{asset('web_image/general.png')}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                                    </div>
                                </div>
                                <div class="col-md-7 col-12 custom-left-border">
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-12">
                                            <span class="fund_goal">{{ $fund->collected_amount ? 'RM '.number_format($fund->collected_amount, 2) : 'RM 0.00' }}</span><span style="font-size:14pt !important; font-weight:bold !important; color:grey !important;"> collected</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-12">
                                            <div style="text-align:justify !important; font-size:16pt !important;">
                                                <b>Description : </b><br>General fun will not have certain expiry date. If donator donate to an expired fund, the money will be automatically transferred to this fund.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <a href="{{ route('donator.donate_general', $fund->id) }}" class="btn btn-success">Donate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        

        <!-- Bootstrap 5 JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script>

        </script>

    </body>
</html>
