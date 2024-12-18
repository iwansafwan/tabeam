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
            height:100px !important;
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
                            <a href="{{ route('treasurer.funds') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <!-- Progress Bar -->
                            <div class="progress" style="height: 10px;">
                                <div id="progressBar" class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 my-2">
                        <div class="col-md-12 col-12">
                            <form id="editFundForm" action="{{ route('treasurer.update_fund') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Section 1 -->
                                <div class="form-section" id="section1">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label"><b>Step 1 of 3</b></label>
                                            <input type="text" name="treasurer_id" value="{{ $treasurer->id }}" hidden>
                                            <input type="text" name="fund_id" value="{{ $fund->id }}" hidden>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <small><b>What the name of this fund ? </b></small><span class="text-danger">*</span>
                                            <input type="text" name="name" class="form-control" style="border-radius:15px !important;" placeholder="e.g Mosque Facilities" value="{{ $fund->name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <small><b>Description of the fund. </b></small><span class="text-danger">*</span>
                                            <textarea name="description" class="form-control" rows="4" style="border-radius:15px !important;" required>{{ $fund->description }}</textarea>
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
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <small>Previous photo / image uploaded</small><br>
                                            <center>
                                                <img src="{{asset('fund_image/'.$fund->image)}}" alt="" style="width:300px !important; height:auto !important; border-radius:15px !important;">
                                            </center>
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
                                            <input type="number" name="target_amount" step="any" class="form-control" style="border-radius:15px !important;" value="{{ $fund->target_amount }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <small><b>When the fund ended ? </b></small><span class="text-danger">*</span>
                                            <input type="date" name="end_date" class="form-control" style="border-radius:15px !important;" value="{{ $fund->end_date }}" required>
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
                                            <small><b>Where donator's fund go? </b></small><span class="text-danger">*</span><br>
                                            <small>Allocation Ratio</small>
                                        </div>
                                        <div class="row align-items-center mb-2">
                                            <div class="col-md-6 col-6">
                                                <small>Fill at least one section / category. Checked section / category cannot be unchecked / deleted.</small>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <small>Ratio (%) <span class="text-danger">Total must equal 100%</span></small>
                                            </div>
                                        </div>
                                        <div class="row mx-0">
                                            <div class="col-md-12 col-12 p-0">
                                                <div id="category_section">
                                                    @foreach ($fund->ratio as $key => $ratio)
                                                        <div class="row align-items-center mb-2 category-row" data-key="{{ $key }}">
                                                            <input type="hidden" name="ratio[{{ $key }}][id]" value="{{ $ratio->id }}">
                                                            <div class="col-md-5 col-5">
                                                                <input type="text" name="ratio[{{ $key }}][category_name]" 
                                                                    class="form-control" 
                                                                    style="border-radius:15px !important;" 
                                                                    value="{{ $ratio->category_name }}" 
                                                                    required>
                                                            </div>
                                                            <div class="col-md-5 col-5">
                                                                <input type="number" name="ratio[{{ $key }}][percentage]" 
                                                                    max="100.00" 
                                                                    step="any" 
                                                                    class="form-control category-ratio" 
                                                                    style="border-radius:15px !important;" 
                                                                    value="{{ $ratio->percentage }}" 
                                                                    required>
                                                            </div>
                                                            <div class="col-md-2 col-2">
                                                                @if ($key === 0)
                                                                    <button type="button" class="btn btn-dark mt-2" id="add_category">+</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger mt-2 remove-category">-</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
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
        </div>
    </div>

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

        let categoryKey = {{ $fund->ratio->count() }}; // Start from the number of existing ratios

        $('#add_category').on('click', function () {
            categoryKey++;

            const newCategory = `
                <div class="row align-items-center mb-2 category-row" data-key="${categoryKey}">
                    <input type="hidden" name="ratio[${categoryKey}][id]" value="0">
                    <div class="col-md-5 col-5">
                        <input type="text" name="ratio[${categoryKey}][category_name]" 
                            class="form-control" 
                            style="border-radius:15px !important;" 
                            placeholder="Category Name" required>
                    </div>
                    <div class="col-md-5 col-5">
                        <input type="number" name="ratio[${categoryKey}][percentage]" 
                            max="100.00" 
                            step="any" 
                            class="form-control category-ratio" 
                            style="border-radius:15px !important;" 
                            placeholder="Percentage" required>
                    </div>
                    <div class="col-md-2 col-2">
                        <button type="button" class="btn btn-danger mt-2 remove-category">-</button>
                    </div>
                </div>`;
            $('#category_section').append(newCategory);
        });

        $(document).on('click', '.remove-category', function () {
            $(this).closest('.category-row').remove();
        });

        $(document).on('submit', '#editFundForm', function (e) {
            let total = 0;

            // Calculate total percentage
            $('.category-ratio').each(function () {
                const value = parseFloat($(this).val()) || 0;
                total += value;
            });

            // Validate total percentage
            if (total !== 100) {
                e.preventDefault(); // Prevent form submission
                alert('Total percentage must equal 100%.');
            }
        });

    });

</script>
