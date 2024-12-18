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
            <span class="title_header">General Fund Details</span>
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
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label m-0">Fund Image : </label>
                                                    <div class="display_box_2">
                                                        <img src="{{asset('web_image/general.png')}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row mb-3">
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label m-0">Total Collected : </label>
                                                    <div class="display_box">
                                                        {{ $fund->collected_amount ? 'RM '.number_format($fund->collected_amount, 2) : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <label class="form-label m-0">Description : </label>
                                                    <div class="display_box_1">
                                                        General fun will not have certain expiry date. If donator donate to an terminated fund, the money will be automatically transferred to this fund.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12 text-center">
                                                    <label class="form-label m-0">QR Code : </label>
                                                    <div class="display_box_2 d-flex justify-content-center">
                                                        <img src="{{asset('general_fund_qrcodes/'.$fund->qr_code)}}" alt="" style="width:200px !important; height:auto !important; border-radius:15px !important;">
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
