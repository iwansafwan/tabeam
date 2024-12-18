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

        @php
            $ratioCount = count($fund->ratio);
            $flexBasis = 100 / $ratioCount;  // Calculate percentage width based on the count
        @endphp
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

            .fund_title{
                font-size:18pt !important;
                font-weight:bold !important;
            }

            .fund_goal{
                font-size:24pt !important;
                font-weight:bold !important;
            }

            .fund_date{
                font-size:14pt !important;
                font-weight:bold !important;
                color:grey !important;
            }

            .ratio_title{
                font-size:14pt !important;
                font-weight:bold !important;
            }

            .ratio_percentage{
                font-size:12pt !important;
                font-weight:bold !important;
                color:grey !important;
            }
            
            .card_1 {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%; /* Ensures the card fills the column height */
            }
            .card_body_1 {
                flex-grow: 1; /* Ensures content takes up available space */
            }
            
            /* Default for desktop view */
            .custom-flex-wrap {
                flex-wrap: nowrap;
            }

            .ratio-col {
                flex: 1 1 {{ $flexBasis }}%; /* Adjust this based on the number of items. You can adjust percentage if needed */
                margin: 5px; /* Space between cards */
            }

            .custom-left-border{
                border-left:2px solid #dddddd !important;
            }


            /* For mobile view (full-width columns) */
            @media (max-width: 767px) {
                .custom-flex-wrap {
                    flex-wrap: wrap !important;
                }

                .ratio-col {
                    flex: 1 1 100% !important; /* Full width on mobile */
                    margin-bottom: 15px !important; /* Space between cards on mobile */
                }

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
                    <span class="title_header">Fund Details</span>
                </div>
            </div>

            <div class="row justify-content-center" style="margin-bottom:30px !important;">
                <div class="col-md-10 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mx-0 my-3">
                                <div class="col-md-4 col-12">
                                    <div class="display_box_2">
                                        <img src="{{asset('fund_image/'.$fund->image)}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 custom-left-border">
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-12">
                                            <span class="fund_title">{{ $fund->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <!-- Progress Bar -->
                                            <div class="progress" style="height: 10px;">
                                                <div id="progressBar" class="progress-bar" role="progressbar"
                                                    style="width: {{ $progressPercentage }}%;" 
                                                    aria-valuenow="{{ $progressPercentage }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100" 
                                                    style="background-color:#11bf00 !important;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <span class="fund_goal">RM {{ number_format($totalCollected, 2) }} / RM {{ number_format($fund->target_amount, 2) }}</span><span style="font-size:14pt !important; font-weight:bold !important; color:grey !important;"> goal</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-12">
                                            <span class="fund_date">Until {{ (new DateTime($fund->end_date))->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    @if($fund->status == 'active')
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <a href="{{ route('donator.donate_main', $fund->id) }}" class="btn btn-success">Donate</a>
                                            </div>
                                        </div>
                                    @elseif($fund->status == 'ended')
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <button type="button" class="btn btn-warning" disabled>Ended</button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <button type="button" class="btn btn-danger" disabled>Terminated</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 col-12 mb-3 custom-left-border">
                                    <div style="text-align:justify !important; font-size:16pt !important;">
                                        <b>Description : </b>{{ $fund->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 my-3 d-flex custom-flex-wrap">
                                @if(isset($fund->ratio) && count($fund->ratio) > 0)
                                    @foreach($fund->ratio as $ratio)
                                        <div class="col ratio-col d-flex align-items-stretch">
                                            <div class="card w-100 h-100 card_1">
                                                <div class="card-body card_body_1">
                                                    <div class="row mx-0">
                                                        <div class="col-md-8 col-8 px-0">
                                                            <span class="ratio_title">{{ $ratio->category_name }}</span><br>
                                                            <span class="ratio_percentage">{{ number_format($ratio->percentage, 0) }}% from Total Donation</span>
                                                        </div>
                                                        @if($fund->status == 'active')
                                                            <div class="col-md-4 col-4 px-0 d-flex align-items-center justify-content-end">
                                                                <a href="{{ route('donator.donate_section', ['fund' => $fund->id, 'section' => $ratio->id]) }}" class="btn btn-success">Donate</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12 col-12">
                                        No section/category for donation.
                                    </div>
                                @endif
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
