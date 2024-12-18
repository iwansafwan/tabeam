<x-app-layout>

    <style>

        input[type='file']{
            height:42px !important;
            border:1px solid black;
            padding:.5rem .75rem !important;
            border-radius:15px !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">Funds</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-0 mb-4">
                        <div class="col-md-12 col-12 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFund">Create Fund</button>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header" style="background:#01ad9d !important; color:white !important;">
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center">
                                            <b>Fund List</b>
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
                                                        <th>Fund Name</th>
                                                        <th class="text-center">Collected Amount / Target Amount (MYR)</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Status</th>
                                                        <th width="20%" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($funds) && count($funds) > 0)
                                                        @foreach($funds as $fund)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>
                                                                    {{ $fund->name }} 
                                                                    @if($fund->status == 'terminated')
                                                                        (Transferred <i class="fa-solid fa-money-bill-transfer"></i> General Fund)
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ $fund->invoice->isNotEmpty() ? 'RM '.number_format($fund->invoice->sum('amount'), 2) : '-' }} / RM {{ $fund->target_amount }}</td>
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
                                                                <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('treasurer.view', $fund->id) }}" class="btn btn-info">View</a>
                                                                        @if($fund->status != 'terminated' && $fund->status != 'ended')
                                                                            <a href="{{ route('treasurer.edit_fund', $fund->id) }}" class="btn btn-warning">Edit</a>
                                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endFund_{{ $fund->id }}">Terminate</button>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6" class="text-center">No Funds Recorded.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if(isset($funds) && count($funds) > 0)
                                        <div class="row mt-3">
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
    
    <!-- Modal -->
    <div class="modal fade" id="createFund" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelcreateFund" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="labelcreateFund"><b>Create Fund</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Progress Bar -->
                <div class="progress" style="height: 10px;">
                    <div id="progressBar" class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- Modal Body -->
                <div class="modal-body" style="font-size:13pt !important;">
                    <form id="createFundForm" action="{{ route('treasurer.submit_fund') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Section 1 -->
                        <div class="form-section" id="section1">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label"><b>Step 1 of 3</b></label>
                                    <input type="text" name="treasurer_id" value="{{ $treasurer->id }}" hidden>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small><b>What the name of this fund ? </b></small><span class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control" style="border-radius:15px !important;" placeholder="e.g Mosque Facilities" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small><b>Description of the fund. </b></small><span class="text-danger">*</span>
                                    <textarea name="description" class="form-control" rows="4" style="border-radius:15px !important;" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small>A photo that would help tell your story and build trust with donators.</small><br>
                                    <center>
                                        <i class="fa-solid fa-image upload-trigger" style="cursor: pointer; font-size: 30pt; margin:20px 0px 20px 0px;"></i>
                                    </center>
                                    <input type="file" id="fundImage" name="image" class="form-control d-none" style="border-radius:15px !important;" accept="image/*">
                                    <div id="fileName" class="text-center mt-2 d-none"></div> <!-- File name will appear here -->
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary next-btn" data-next="section2">Next</button>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="form-section d-none" id="section2">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label"><b>Step 2 of 3</b></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small><b>How much would you like to raise (MYR) ? </b></small><span class="text-danger">*</span>
                                    <input type="number" name="target_amount" step="any" class="form-control" style="border-radius:15px !important;" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small><b>When the fund ended ? </b></small><span class="text-danger">*</span>
                                    <input type="date" name="end_date" class="form-control" style="border-radius:15px !important;" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary prev-btn" data-prev="section1">Back</button>
                                <button type="button" class="btn btn-primary next-btn" data-next="section3">Next</button>
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div class="form-section d-none" id="section3">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label"><b>Step 3 of 3</b></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small><b>Where donator's fund go ? </b></small><span class="text-danger">*</span><br>
                                    <small>Allocation Ratio</small>
                                </div>
                                <div class="row align-items-center mb-2">
                                    <div class="col-md-6 col-6">
                                        <small>Check at least one.</small>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <small>Ratio (%) <span class="text-danger">Total must 100%</span></small>
                                    </div>
                                </div>
                                <div class="row mx-0">
                                    <div class="col-md-12 col-12 p-0">
                                        <div id="category_section">
                                            <div class="row align-items-center mb-2 category-row" data-key="0">
                                                <div class="col-md-5 col-5">
                                                    <input type="text" name="ratio[0][category_name]" class="form-control" style="border-radius:15px !important;" placeholder="Food" required>
                                                </div>
                                                <div class="col-md-5 col-5">
                                                    <input type="number" name="ratio[0][percentage]" max="100.00" step="any" class="form-control category-ratio" style="border-radius:15px !important;" placeholder="Percentage" required>
                                                </div>
                                                <div class="col-md-2 col-2">
                                                    <button type="button" class="btn btn-dark mt-2" id="add_category">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary prev-btn" data-prev="section2">Back</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    {{-- for end fund modal --}}
    @if(isset($funds) && count($funds) > 0)
        @foreach($funds as $fund)
            <!-- Modal -->
            <div class="modal fade" id="endFund_{{ $fund->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="labelendFund_{{ $fund->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="labelendFund_{{ $fund->id }}"><b>Terminate Fund</b></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body" style="font-size:13pt !important;">
                            <form id="endFundForm" action="{{ route('treasurer.terminate_fund') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 text-center">
                                        <b>Are you sure to terminate fund?</b>
                                        <input type="text" name="fund_id" value="{{ $fund->id }}" hidden>
                                        <input type="text" name="treasurer_id" value="{{ $treasurer->id }}" hidden>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 text-center">
                                        <small class="text-danger">All collected fund will be transferred to general fund.</small>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12 col-12 text-center">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit" class="btn btn-success">Sure</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</x-app-layout>

<script>

    $(document).ready(function () {
        const sections = $('.form-section').length;

        $('.upload-trigger').on('click', function () {
            $('#fundImage').trigger('click'); // Simulate a click on the file input
        });

        $('#fundImage').on('change', function () {
            const fileName = $(this).val().split('\\').pop(); // Extract file name

            if (fileName) {
                // Change the icon to the regular image icon
                $('.upload-trigger').removeClass('fa-solid fa-image').addClass('fa-regular fa-image');
                
                // Show the file name below the icon
                $('#fileName').removeClass('d-none').text(fileName);
            } else {
                // Reset to original icon and hide file name if no file is selected
                $('.upload-trigger').removeClass('fa-regular fa-image').addClass('fa-solid fa-image');
                $('#fileName').addClass('d-none');
            }
        });

        function updateProgressBar(currentSection) {
            const progress = (currentSection / sections) * 100;
            $('#progressBar').css('width', `${progress}%`).attr('aria-valuenow', progress);
        }

        function validateCurrentSection(sectionId) {
            let isValid = true;

            // Check all inputs and textareas in the current section
            $(`#${sectionId} input, #${sectionId} textarea`).each(function () {
                if (!this.checkValidity()) {
                    isValid = false;
                    this.reportValidity(); // Show validation message
                    return false; // Stop the loop on first invalid input
                }
            });

            return isValid;
        }

        $('.next-btn').on('click', function () {
            const currentSection = $(this).closest('.form-section').attr('id');
            const nextSection = $(this).data('next');

            if (validateCurrentSection(currentSection)) {
                // Hide current section and show next section
                $(this).closest('.form-section').addClass('d-none');
                $(`#${nextSection}`).removeClass('d-none');
                updateProgressBar(nextSection.replace('section', '')); // Update progress bar
            }
        });

        $('.prev-btn').on('click', function () {
            const currentSection = $(this).closest('.form-section').attr('id');
            const prevSection = $(this).data('prev');

            // Navigate back without validation
            $(this).closest('.form-section').addClass('d-none');
            $(`#${prevSection}`).removeClass('d-none');
            updateProgressBar(prevSection.replace('section', '')); // Update progress bar
        });

        updateProgressBar(1); // Initialize progress bar
        
        let rowKey = 0; // Initialize row key

        // Add a new category row
        $(document).on('click', '#add_category', function () {
            // Change the current "Add" button to a "Remove" button
            $(this)
                .removeClass('btn-dark')
                .addClass('btn-danger remove-category')
                .removeAttr('id')
                .text('-');

            // Increment the row key
            rowKey++;

            // Add a new row with a unique key
            const newCategoryRow = `
                <div class="row align-items-center mb-2 category-row" data-key="${rowKey}">
                    <div class="col-md-5 col-5">
                        <input type="text" name="ratio[${rowKey}][category_name]" class="form-control" style="border-radius:15px !important;" placeholder="Category" required>
                    </div>
                    <div class="col-md-5 col-5">
                        <input type="number" name="ratio[${rowKey}][percentage]" max="100.00" step="any" class="form-control category-ratio" style="border-radius:15px !important;" placeholder="Percentage" required>
                    </div>
                    <div class="col-md-2 col-2">
                        <button type="button" class="btn btn-dark mt-2" id="add_category">+</button>
                    </div>
                </div>`;
            $('#category_section').append(newCategoryRow);
        });

        // Remove a category row and update keys
        $(document).on('click', '.remove-category', function () {
            $(this).closest('.category-row').remove();
            updateKeys();

            // If only one row remains, ensure it has the "Add" button
            if ($('#category_section .category-row').length === 1) {
                const lastRowButton = $('#category_section .category-row .btn');
                lastRowButton
                    .removeClass('btn-danger remove-category')
                    .addClass('btn-dark')
                    .attr('id', 'add_category')
                    .text('+');
            }
        });

        // Update keys for all rows
        function updateKeys() {
            rowKey = 0; // Reset key counter
            $('#category_section .category-row').each(function () {
                $(this).attr('data-key', rowKey); // Update data-key
                $(this)
                    .find('input[name^="ratio"]')
                    .each(function () {
                        const fieldName = $(this).attr('name');
                        const updatedName = fieldName.replace(/ratio\[\d+\]/, `ratio[${rowKey}]`);
                        $(this).attr('name', updatedName); // Update name attribute
                    });
                rowKey++; // Increment for the next row
            });
        }

        // Validate total ratio on form submission
        $('#createFundForm').on('submit', function (e) {
            let totalRatio = 0;

            $('.category-ratio').each(function () {
                const value = parseFloat($(this).val()) || 0;
                totalRatio += value;
            });

            // Check if the total ratio equals 100%
            if (totalRatio !== 100) {
                e.preventDefault();
                alert('Total ratio must equal 100%!');
            }
        });

    });


</script>
