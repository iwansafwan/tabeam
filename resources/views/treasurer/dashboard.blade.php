<x-app-layout>

    <style>

        .dashboard_mini_title{
            font-size:20pt !important;
            font-weight:bold !important;
        }

        .count_number{
            font-size:30pt !important;
            font-weight:bold !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Dashboard Treasurer</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="row mx-0 justify-content-between">
                <div class="col-md-6 col-12 my-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mx-0 my-2">
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-hand-holding-dollar" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total<br>Fund Created</span>
                                </div>
                                <div class="col-md-5 col-5 d-flex align-items-center justify-content-center">
                                    <span class="count_number">{{ $fundCount ? $fundCount : '0' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 my-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mx-0 my-2">
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-sack-dollar" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-5 col-5 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Overall<br>Fund Collected</span>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-center">
                                    <span class="count_number">RM {{ $overallCollected ? number_format($overallCollected, 2) : '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
