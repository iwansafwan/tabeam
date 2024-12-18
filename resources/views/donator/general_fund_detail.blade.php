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

        .custom-left-border{
            border-left:2px solid #dddddd !important;
        }

        .fund_goal{
            font-size:24pt !important;
            font-weight:bold !important;
        }


        /* For mobile view (full-width columns) */
        @media (max-width: 767px) {

            .custom-left-border{
                border-left:none !important;
                border-top:2px solid #dddddd !important;
                margin-top:20px !important;
                padding-top:20px !important;
            }
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
                    <div class="row mx-0 my-3">
                        <div class="col-md-5 col-12">
                            <div class="display_box_2">
                                <img src="{{asset('web_image/general.png')}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                            </div>
                        </div>
                        <div class="col-md-7 col-12 custom-left-border">
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <span class="fund_goal">{{ $fund->collected_amount ? 'RM '.number_format($fund->collected_amount, 2) : 'RM 0.00' }}</span><span style="font-size:14pt !important; font-weight:bold !important; color:grey !important;"> collected</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <div style="text-align:justify !important; font-size:16pt !important;">
                                        <b>Description : </b><br>General fun will not have certain expiry date. If donator donate to an expired fund, the money will be automatically transferred to this fund.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a href="{{ route('donator.donate_general', $fund->id) }}" class="btn btn-success">Donate</a>
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
