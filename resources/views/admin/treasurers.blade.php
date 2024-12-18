
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <b>Treasurer List</b>
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
                                    <th class="text-center">Total Funds</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($treasurers) && count($treasurers) > 0)
                                    @foreach($treasurers as $treasurer)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $treasurer->name }}</td>
                                            <td>{{ $treasurer->email }}</td>
                                            <td class="text-center">
                                                @if ($treasurer->fund->isNotEmpty())
                                                    {{ $treasurer->fund->count() }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.view_treasurer', $treasurer->id) }}" class="btn btn-info">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No Treasurers Account Recorded.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(isset($treasurers) && count($treasurers) > 0)
                    <div class="row mt-3">
                        <div class="col-md-12 col-12">
                            {{ $treasurers->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createTreasurer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel"><b>Create Treasurer Account</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size:13pt !important;">
                <form action="{{ route('admin.create_treasurer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 mx-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <label class="form-label mb-0">Full Name : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" style="border-radius:15px !important;" value="{{ old('name') }}" placeholder="Please type full name." required>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <label class="form-label mb-0">Email : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" style="border-radius:15px !important;" value="{{ old('email') }}" placeholder="Please type email." required>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <label class="form-label mb-0">Password : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password" class="form-control" style="border-radius:15px !important;" value="{{ old('password') }}" placeholder="Please type password." required>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <label class="form-label mb-0">Confirm Password : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" style="border-radius:15px !important;" value="{{ old('password_confirmation') }}" placeholder="Please type confirm password." required>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <label class="form-label mb-0">Temporary Contact : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="contact_number" id="contact_number" class="form-control" style="border-radius:15px !important;" value="{{ old('contact_number') }}" placeholder="Please type temporary contact number." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

</script>
