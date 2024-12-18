
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <b>Donator List</b>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Total Donation (MYR)</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($donators) && count($donators) > 0)
                                    @foreach($donators as $donator)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $donator->name }}</td>
                                            <td>{{ $donator->email }}</td>
                                            <td class="text-center">{{ $donator->invoice->isNotEmpty() ? 'RM '.$donator->invoice->sum('amount') : '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.view_donator', $donator->id) }}" class="btn btn-info">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No Donators Account Recorded.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(isset($donators) && count($donators) > 0)
                    <div class="row mt-3">
                        <div class="col-md-12 col-12">
                            {{ $donators->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
</script>
