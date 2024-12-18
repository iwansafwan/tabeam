<x-app-layout>

    <style>

        .fund_title{
            font-size:18pt !important;
            font-weight:bold !important;
        }

        .fund_date{
            font-size:14pt !important;
            font-weight:bold !important;
            color:grey !important;
        }

        .donate_by{
            font-size:14pt !important;
            /* font-weight:bold !important; */
            color:black !important;
        }

        .fund_notes{
            font-size:14pt !important;
            /* font-weight:bold !important; */
            color:grey !important;
        }

        .trans_amount{
            font-size:20pt !important;
            font-weight:bold !important;
            color:green !important;
        }

        .custom-image{
            width:200px !important;
            height:200px !important;
            border-radius:15px !important;
        }

        /* For mobile view (full-width columns) */
        @media (max-width: 767px) {
            
            .custom-image{
                width:100px !important;
                height:100px !important;
                border-radius:15px !important;
            }

        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Transactions</span>
        </div>
    </div>
    <div class="row" style="margin-bottom:30px !important;">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 my-3">
                        <div class="col-md-12 col-12 px-0">
                            @if(isset($transactions) && count($transactions) > 0)
                                @foreach($transactions as $trans)
                                    <div class="card my-2">
                                        <div class="card-body">
                                            <div class="row mx-0">
                                                <div class="col-md-2 col-2 px-0 d-flex align-items-center justify-content-center">
                                                    @if($trans->donation_type == 'general')
                                                        <img src="{{asset('web_image/general.png')}}" class="custom-image" alt="">
                                                    @elseif($trans->donation_type == 'main')
                                                        <img src="{{asset('fund_image/'.$trans->fund->image)}}" class="custom-image" alt="">
                                                    @else
                                                        <img src="{{asset('fund_image/'.$trans->fund->image)}}" class="custom-image" alt="">
                                                    @endif
                                                </div>
                                                <div class="col-md-7 col-7 d-flex align-items-center">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 col-12 my-2">
                                                            @if($trans->donation_type == 'general')
                                                                <span class="fund_title">{{ $trans->general_fund->name }}</span>
                                                            @elseif($trans->donation_type == 'main')
                                                                <span class="fund_title">{{ $trans->fund->name }}
                                                                    @if($trans->fund->status == 'active')
                                                                        &nbsp;(<span class="text-success">Active</span>)
                                                                    @elseif($trans->status == 'ended')
                                                                        &nbsp;(<span class="text-warning">Ended</span>)
                                                                    @else
                                                                        &nbsp;(<span class="text-danger">Terminated</span>)
                                                                    @endif
                                                                    @if($trans->general_fund_id != NULL)
                                                                        <br><i class="fa-solid fa-money-bill-transfer"></i> General Fund
                                                                    @endif
                                                                </span>
                                                            @else
                                                                <span class="fund_title">{{ $trans->fund->name }}
                                                                    @if($trans->fund->status == 'active')
                                                                        &nbsp;(<span class="text-success">Active</span>)
                                                                    @elseif($trans->status == 'ended')
                                                                        &nbsp;(<span class="text-warning">Ended</span>)
                                                                    @else
                                                                        &nbsp;(<span class="text-danger">Terminated</span>)
                                                                    @endif
                                                                    @if($trans->general_fund_id != NULL)
                                                                        <br><i class="fa-solid fa-money-bill-transfer"></i> General Fund
                                                                    @endif
                                                                    <br>Section : {{ $trans->ratio->category_name }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-12 col-12 my-1">
                                                            <span class="fund_date"><i class="fa-solid fa-calendar-days"></i> {{ (new DateTime($trans->created_at))->format('d/m/Y') }}</span>&nbsp;&nbsp;&nbsp;
                                                            <span class="fund_date"><i class="fa-solid fa-clock"></i> {{ (new DateTime($trans->created_at))->format('h:i A') }}</span>
                                                        </div>
                                                        <div class="col-md-12 col-12 my-1">
                                                            <span class="donate_by"><i class="fa-solid fa-user"></i> Donate By : {{ $trans->donator->name }}</span>
                                                        </div>
                                                        @if($trans->notes != NULL)
                                                            <div class="col-md-12 col-12 my-1">
                                                                <span class="fund_notes"><i class="fa-solid fa-comment-dots"></i> Notes : {{ $trans->notes }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-3 d-flex align-items-center justify-content-end">
                                                    <span class="trans_amount">+ RM {{ number_format($trans->amount, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <center>No transactions record from funds.</center>
                            @endif
                        </div>
                    </div>
                    @if(isset($transactions) && count($transactions) > 0)
                        <div class="row mx-0 my-2">
                            <div class="col-md-12 col-12">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>

    $(document).ready(function () {

    });

</script>
