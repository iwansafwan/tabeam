<x-app-layout>

        
    @php
        $ratioCount = count($fund->ratio);
        $flexBasis = 100 / $ratioCount;  // Calculate percentage width based on the count
    @endphp
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

        .fund_title{
            font-size:18pt !important;
            font-weight:bold !important;
        }

        .fund_goal{
            font-size:24pt !important;
            font-weight:bold !important;
        }

        .fund_date{
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
        
        .card_1 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Ensures the card fills the column height */
        }
        .card_body_1 {
            flex-grow: 1; /* Ensures content takes up available space */
        }
        
        /* Default for desktop view */
        .custom-flex-wrap {
            flex-wrap: nowrap;
        }

        .ratio-col {
            flex: 1 1 {{ $flexBasis }}%; /* Adjust this based on the number of items. You can adjust percentage if needed */
            margin: 5px; /* Space between cards */
        }

        .custom-left-border{
            border-left:2px solid #dddddd !important;
        }


        /* For mobile view (full-width columns) */
        @media (max-width: 767px) {
            .custom-flex-wrap {
                flex-wrap: wrap !important;
            }

            .ratio-col {
                flex: 1 1 100% !important; /* Full width on mobile */
                margin-bottom: 15px !important; /* Space between cards on mobile */
            }

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
            <span class="title_header">Fund Details</span>
        </div>
    </div>
    <div class="row" style="margin-bottom:30px !important;">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 my-3">
                        <div class="col-md-4 col-12">
                            <div class="display_box_2">
                                <img src="{{asset('fund_image/'.$fund->image)}}" alt="" style="width:100% !important; height:auto !important; border-radius:15px !important;">
                            </div>
                        </div>
                        <div class="col-md-4 col-12 custom-left-border">
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <span class="fund_title">{{ $fund->name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <!-- Progress Bar -->
                                    <div class="progress" style="height: 10px;">
                                        <div id="progressBar" class="progress-bar" role="progressbar"
                                            style="width: {{ $progressPercentage }}%;" 
                                            aria-valuenow="{{ $progressPercentage }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100" 
                                            style="background-color:#11bf00 !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <span class="fund_goal">RM {{ number_format($totalCollected, 2) }} / RM {{ number_format($fund->target_amount, 2) }}</span><span style="font-size:14pt !important; font-weight:bold !important; color:grey !important;"> goal</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <span class="fund_date">Until {{ (new DateTime($fund->end_date))->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            @if($fund->status == 'active')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <a href="{{ route('donator.donate_main', $fund->id) }}" class="btn btn-success">Donate</a>
                                    </div>
                                </div>
                            @elseif($fund->status == 'ended')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <button type="button" class="btn btn-warning" disabled>Ended</button>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <button type="button" class="btn btn-danger" disabled>Terminated</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 col-12 mb-3 custom-left-border">
                            <div style="text-align:justify !important; font-size:16pt !important;">
                                <b>Description : </b>{{ $fund->description }}
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 my-3 d-flex custom-flex-wrap">
                        @if(isset($fund->ratio) && count($fund->ratio) > 0)
                            @foreach($fund->ratio as $ratio)
                                <div class="col ratio-col d-flex align-items-stretch">
                                    <div class="card w-100 h-100 card_1">
                                        <div class="card-body card_body_1">
                                            <div class="row mx-0">
                                                <div class="col-md-8 col-8 px-0">
                                                    <span class="ratio_title">{{ $ratio->category_name }}</span><br>
                                                    <span class="ratio_percentage">{{ number_format($ratio->percentage, 0) }}% from Total Donation</span>
                                                </div>
                                                @if($fund->status == 'active')
                                                    <div class="col-md-4 col-4 px-0 d-flex align-items-center justify-content-end">
                                                        <a href="{{ route('donator.donate_section', ['fund' => $fund->id, 'section' => $ratio->id]) }}" class="btn btn-success">Donate</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 col-12">
                                No section/category for donation.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>

    $(document).ready(function () {

    });

</script>
