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
                    <span class="title_header">Welcome to TABEAM System</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mx-0 my-2">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                                            <div class="row">
                                                <div class="col-auto d-flex align-items-center">
                                                    <b>General Fund</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th width="3%" class="text-center">#</th>
                                                                <th>Fund Name</th>
                                                                <th class="text-center">Collected Amount (MYR)</th>
                                                                <th class="text-center">Status</th>
                                                                <th width="20%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($g_fund) && !empty($g_fund))
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td>{{ $g_fund->name }}</td>
                                                                    <td class="text-center">{{ $g_fund->collected_amount ? 'RM '.number_format($g_fund->collected_amount, 2) : '-' }}</td>
                                                                    <td class="text-center">
                                                                        <span class="badge bg-success">Active</span>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('guest.general_fund_details') }}" class="btn btn-info">View</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td class="text-center" colspan="5">No General Fund account created.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 my-2">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                                            <div class="row">
                                                <div class="col-auto d-flex align-items-center">
                                                    <b>Fund List</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th width="3%" class="text-center">#</th>
                                                                <th>Picture / Image</th>
                                                                <th>Fund Name</th>
                                                                <th class="text-center">Collected Amount / Target Amount (MYR)</th>
                                                                <th class="text-center">End Date</th>
                                                                <th class="text-center">Status</th>
                                                                <th width="10%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($funds) && count($funds) > 0)
                                                                @foreach($funds as $fund)
                                                                    <tr>
                                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                                        <td>
                                                                            <img src="{{asset('fund_image/'.$fund->image)}}" alt="" style="width:150px !important; height:auto !important; border-radius:15px !important;">
                                                                        </td>
                                                                        <td>
                                                                            {{ $fund->name }} 
                                                                            @if($fund->status == 'terminated')
                                                                                (Transferred <i class="fa-solid fa-money-bill-transfer"></i> General Fund)
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">{{ $fund->invoice->isNotEmpty() ? 'RM '.$fund->invoice->sum('amount') : '-' }} / RM {{ $fund->target_amount }}</td>
                                                                        <td class="text-center">{{ (new DateTime($fund->end_date))->format('d/m/Y') }}</td>
                                                                        <td class="text-center">
                                                                            @if($fund->status == 'active')
                                                                                <span class="badge bg-success">Active</span>
                                                                            @elseif($fund->status == 'terminated')
                                                                                <span class="badge bg-danger">Terminated</span>
                                                                            @else
                                                                                <span class="badge bg-warning">Ended</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group">
                                                                                <a href="{{ route('guest.fund_details', $fund->id) }}" class="btn btn-info">View</a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No Funds Recorded.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if(isset($funds) && count($funds) > 0)
                                                <div class="row mt-3">
                                                    <div class="col-md-12 col-12">
                                                        {{ $funds->links() }}
                                                    </div>
                                                </div>
                                            @endif
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
