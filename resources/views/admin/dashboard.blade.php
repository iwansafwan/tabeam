<x-app-layout>

    <style>
        .dashboard_mini_title {
            font-size: 24pt !important;
            font-weight: bold !important;
        }

        .count_number {
            font-size: 38pt !important;
            font-weight: bold !important;
        }
    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Dashboard Admin</span>
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
                                    <i class="fa-solid fa-user-tie" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-6 col-6 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total Treasurers</span>
                                </div>
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <span class="count_number">{{ $treasurerCount ? $treasurerCount : '0' }}</span>
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
                                    <i class="fa-solid fa-users" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-6 col-6 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total Donators</span>
                                </div>
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <span class="count_number">{{ $donatorCount ? $donatorCount : '0' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-0 justify-content-between">
                <div class="col-md-6 col-12 my-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mx-0 my-2">
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-sack-dollar" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-6 col-6 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total Funds</span>
                                </div>
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
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
                                    <i class="fa-solid fa-hand-holding-dollar" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-6 col-6 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total Transactions</span>
                                </div>
                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-center">
                                    <span class="count_number">{{ $invoiceCount ? $invoiceCount : '0' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
