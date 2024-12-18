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
            <span class="title_header">Fund Details</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 mb-4">
                        <div class="col-md-12 col-12">
                            <a href="{{ route('admin.funds') }}" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center">
                                            <b>{{ $fund->name }}</b>
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
                                                        {{ $fund->treasurer->name }}
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
                                                        {{ $fund->treasurer->email }}
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
                                                        {{ $fund->treasurer->contact_number }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Target Amount : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box">
                                                        RM {{ number_format($fund->target_amount, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-3 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">End Date : </label>
                                                </div>
                                                <div class="col-md-9 col-12">
                                                    <div class="display_box">
                                                        {{ (new DateTime($fund->end_date))->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Status : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box">
                                                        @if($fund->status == 'active')
                                                            <span class="badge bg-success">Active</span>
                                                        @elseif($fund->status == 'terminated')
                                                            <span class="badge bg-danger">Terminated</span>
                                                        @else
                                                            <span class="badge bg-warning">Ended</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Description : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box_1">
                                                        {{ $fund->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-3 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Ratio : </label>
                                                </div>
                                                <div class="col-md-9 col-12">
                                                    @if(isset($fund->ratio) && count($fund->ratio) > 0)
                                                        @foreach($fund->ratio as $ratio)
                                                            <div class="display_box my-2">
                                                                {{ $ratio->category_name }} - {{ $ratio->percentage }}% - Collected = RM {{ number_format($ratio->total_collected, 2) }}
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="display_box">
                                                            -
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-4 col-12 d-flex align-items-center">
                                                    <label class="form-label m-0">Total Collected (MYR) : </label>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="display_box">
                                                        {{ $fund->invoice->isNotEmpty() ? 'RM '.$fund->invoice->sum('amount') : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label m-0">Fund Image : </label>
                                                    <div class="display_box_2">
                                                        <img src="{{asset('fund_image/'.$fund->image)}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label m-0">QR Code : </label>
                                                    <div class="display_box_2">
                                                        <img src="{{asset('fund_qrcodes/'.$fund->qr_code)}}" alt="" style="width:50% !important; height:auto !important; border-radius:15px !important;">
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
            </div>
        </div>
    </div>

</x-app-layout>

<script>


</script>
