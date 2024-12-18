<x-app-layout>

    <style>

        input[type='file']{
            height:42px !important;
            border:1px solid black;
            padding:.5rem .75rem !important;
            border-radius:15px !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Funds</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
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
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>{{ $g_fund->name }}</td>
                                                        <td class="text-center">{{ $g_fund->collected_amount ? 'RM '.number_format($g_fund->collected_amount, 2) : '-' }}</td>
                                                        <td class="text-center">
                                                            <span class="badge bg-success">Active</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('admin.general_fund') }}" class="btn btn-info">View</a>
                                                            </div>
                                                        </td>
                                                    </tr>
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
                                                        <th>Treasurer</th>
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
                                                                <td>{{ $fund->treasurer->name }}</td>
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
                                                                        <a href="{{ route('admin.view', $fund->id) }}" class="btn btn-info">View</a>
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

</x-app-layout>

<script>


</script>
