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
            <span class="title_header">Donator Details</span>
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
                                            <b>Donator Information</b>
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
                                                        {{ $donator->name }}
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
                                                        {{ $donator->email }}
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
                                                        {{ $donator->contact_number }}
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
                                            <b>Donator's Transaction List</b>
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
                                                                <th class="text-center">Donate Amount</th>
                                                                <th class="text-center">Transaction Date</th>
                                                                <th class="text-center">Notes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($transactions) && count($transactions) > 0)
                                                                @foreach($transactions as $trans)
                                                                    <tr>
                                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                                        <td>
                                                                            @if($trans->donation_type == 'general')
                                                                                {{ $trans->general_fund->name }}
                                                                            @elseif($trans->donation_type == 'main')
                                                                                {{ $trans->fund->name }}
                                                                            @else
                                                                                {{ $trans->fund->name }} ({{ $trans->ratio->category_name }})
                                                                            @endif
                                                                        </td>
                                                                        <td class="text-center">RM {{ number_format($trans->amount, 2) }}</td>
                                                                        <td class="text-center">{{ (new DateTime($trans->created_at))->format('d/m/Y') }}</td>
                                                                        <td class="text-center">
                                                                            {{ $trans->notes ? $trans->notes : '-' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No transactions made by treasurer.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if(isset($transactions) && count($transactions) > 0)
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        {{ $transactions->links() }}
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
