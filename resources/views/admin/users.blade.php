<x-app-layout>

    <style>

        .nav-tabs{
            border-bottom:2px solid black !important;
            width:100% !important;
        }

        .nav-tabs .nav-link{
            font-size:16pt !important;
            /* border:2px solid #fc822c !important; */
            background-color:white !important;
            color:black !important;
        }

        .nav-tabs .nav-link.active{
            font-size:16pt !important;
            font-weight:bold !important;
            border-top:2px solid black !important;
            border-left:2px solid black !important;
            border-right:2px solid black !important;
            border-bottom:1px solid black !important;
            background-color:#33f9a7 !important;
            color:black !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Users</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 mb-4">
                        <div class="col-md-12 col-12 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTreasurer">Create Treasurer</button>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <nav class="mb-3">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active flex-fill" id="nav-treasurer-tab" data-bs-toggle="tab" data-bs-target="#nav-treasurer" type="button" role="tab" aria-controls="nav-treasurer" aria-selected="true">Treasurers</button>
                                    <button class="nav-link flex-fill" id="nav-donator-tab" data-bs-toggle="tab" data-bs-target="#nav-donator" type="button" role="tab" aria-controls="nav-donator" aria-selected="false">Donators</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-treasurer" role="tabpanel" aria-labelledby="nav-treasurer-tab">
                                    @include('admin.treasurers')
                                </div>
                                <div class="tab-pane fade" id="nav-donator" role="tabpanel" aria-labelledby="nav-donator-tab">
                                    @include('admin.donators')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
