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
            <span class="title_header">Dashboard Donator</span>
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
                                    <i class="fa-solid fa-money-bill-transfer" style="font-size:60pt !important;"></i>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total<br>Transactions</span>
                                </div>
                                <div class="col-md-5 col-5 d-flex align-items-center justify-content-center">
                                    <span class="count_number">{{ $invoiceCount ? $invoiceCount : '0' }}</span>
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
                                <div class="col-md-4 col-4 d-flex align-items-center">
                                    <span class="dashboard_mini_title">Total<br>Donations</span>
                                </div>
                                <div class="col-md-5 col-5 d-flex align-items-center justify-content-center">
                                    <span class="count_number">RM
                                        {{ $totalDonation ? number_format($totalDonation, 2) : '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mx-0 my-3">
        <div class="col-md-12 col-12">
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
                                                    @if (isset($g_fund) && !empty($g_fund))
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>{{ $g_fund->name }}</td>
                                                            <td class="text-center">
                                                                {{ $g_fund->collected_amount ? 'RM ' . number_format($g_fund->collected_amount, 2) : '-' }}
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-success">Active</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('guest.general_fund_details') }}"
                                                                        class="btn btn-info">View</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="5">No General Fund
                                                                account created.</td>
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
                                                        <th class="text-center">Collected Amount / Target Amount (MYR)
                                                        </th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Status</th>
                                                        <th width="10%" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($funds) && count($funds) > 0)
                                                        @foreach ($funds as $fund)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>
                                                                    <img src="{{ asset('fund_image/' . $fund->image) }}"
                                                                        alt=""
                                                                        style="width:150px !important; height:auto !important; border-radius:15px !important;">
                                                                </td>
                                                                <td>
                                                                    {{ $fund->name }}
                                                                    @if ($fund->status == 'terminated')
                                                                        (Transferred <i
                                                                            class="fa-solid fa-money-bill-transfer"></i>
                                                                        General Fund)
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $fund->invoice->isNotEmpty() ? 'RM ' . $fund->invoice->sum('amount') : '-' }}
                                                                    / RM {{ $fund->target_amount }}</td>
                                                                <td class="text-center">
                                                                    {{ (new DateTime($fund->end_date))->format('d/m/Y') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($fund->status == 'active')
                                                                        <span class="badge bg-success">Active</span>
                                                                    @elseif($fund->status == 'terminated')
                                                                        <span class="badge bg-danger">Terminated</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Ended</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('guest.fund_details', $fund->id) }}"
                                                                            class="btn btn-info">View</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="7" class="text-center">No Funds Recorded.
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if (isset($funds) && count($funds) > 0)
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

</x-app-layout>
