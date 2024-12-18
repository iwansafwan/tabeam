<x-app-layout>

    <style>

        .display_box{
            width:100% !important;
            border:1px solid black;
            padding: .5rem .75rem !important;
            border-radius:15px !important;
        }
        
        .display_box_1{
            width:100% !important;
            border:1px solid black;
            padding: .5rem .75rem !important;
            min-height:100px !important;
            border-radius:15px !important;
        }
        
        .display_box_2{
            width:100% !important;
            padding: 10px 0px !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Treasurer Details</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 mb-4">
                        <div class="col-md-12 col-12">
                            <a href="{{ route('admin.users') }}" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center">
                                            <b>Treasurer Information</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row my-3">
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Treasurer Name : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box">
                                                        {{ $treasurer->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-3 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Email : </label>
                                                </div>
                                                <div class="col-md-9 col-12">
                                                    <div class="display_box">
                                                        {{ $treasurer->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Contact Number : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box">
                                                        {{ $treasurer->contact_number }}
                                                    </div>
                                                </div>
                                            </div>
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
                                            <b>Treasurer's Fund List</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row my-3">
                                        <div class="col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th>Fund Name</th>
                                                                <th class="text-center">Target Amount</th>
                                                                <th class="text-center">End Date</th>
                                                                <th class="text-center">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($funds) && count($funds) > 0)
                                                                @foreach($funds as $fund)
                                                                    <tr>
                                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                                        <td>{{ $fund->name }}</td>
                                                                        <td class="text-center">RM {{ number_format($fund->target_amount, 2) }}</td>
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
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No funds created by treasurer.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if(isset($funds) && count($funds) > 0)
                                                <div class="row">
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
    </div>

</x-app-layout>

<script>


</script>
