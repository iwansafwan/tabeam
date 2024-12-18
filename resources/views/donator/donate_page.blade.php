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

        .name_title{
            font-size:18pt !important;
            font-weight:bold !important;
        }

        .fund_goal{
            font-size:24pt !important;
            font-weight:bold !important;
        }

        .contact_number{
            font-size:14pt !important;
            font-weight:bold !important;
            color:grey !important;
        }

        .ratio_title{
            font-size:14pt !important;
            font-weight:bold !important;
        }

        .ratio_percentage{
            font-size:12pt !important;
            font-weight:bold !important;
            color:grey !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Payment</span>
        </div>
    </div>
    <div class="row" style="margin-bottom:30px !important;">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('donator.submit_payment') }}" method="POST">
                        @csrf
                        <div class="row mx-0 my-3">
                            <div class="col-md-4 col-12 my-3">
                                <div class="row mx-0">
                                    <div class="col-md-4 col-4 text-center">
                                        <i class="fa-solid fa-user-shield" style="font-size:36pt !important;"></i>
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <span class="name_title">{{ $donator->name }}</span><br>
                                        <span class="contact_number">{{ $donator->contact_number }}</span>
                                        <input type="text" name="donator_id" value="{{ $donator->id }}" hidden>
                                        {{-- check what type of donation --}}
                                        <input type="text" name="donation_type" value="{{ isset($general_fund_id) ? 'general' : (isset($fund_id) && isset($ratio_id) ? 'section' : 'main') }}" hidden>
                                        @if(isset($general_fund_id))
                                            <input type="text" name="general_fund_id" value="{{ $general_fund_id }}" hidden>
                                        @elseif(isset($fund_id) && isset($ratio_id))
                                            <input type="text" name="fund_id" value="{{ $fund_id }}" hidden>
                                            <input type="text" name="ratio_id" value="{{ $ratio_id }}" hidden>
                                        @else
                                            <input type="text" name="fund_id" value="{{ $fund_id }}" hidden>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 my-3">
                                <div class="row mx-0 my-3">
                                    <div class="col-md-12 col-12">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" class="form-control" style="border-radius:15px !important;" placeholder="20/30/40/50/100" required>
                                    </div>
                                </div>
                                <div class="row my-3 mx-0 justify-content-center">
                                    <div class="col-auto">
                                        <img src="{{asset('web_image/tng.png')}}" alt="" style="width:auto !important; height:30px !important;">
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('web_image/paypal.png')}}" alt="" style="width:auto !important; height:30px !important;">
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('web_image/apple.png')}}" alt="" style="width:auto !important; height:30px !important;">
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('web_image/visa.png')}}" alt="" style="width:auto !important; height:30px !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 my-3">
                                <div class="row mx-0 my-3">
                                    <div class="col-md-12 col-12">
                                        <label class="form-label">Notes</label>
                                        <input type="text" name="notes" class="form-control" style="border-radius:15px !important;" placeholder="Notes....">
                                    </div>
                                </div>
                                <div class="row mx-0 my-3">
                                    <div class="col-md-12 col-12">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" style="border-radius:15px !important;" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 my-3 justify-content-center">
                            <div class="col-md-3 col-12">
                                <button type="submit" class="btn btn-success w-100">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>

    $(document).ready(function () {

    });

</script>
