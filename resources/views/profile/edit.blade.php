<x-app-layout>
    

    <div class="row">
        <div class="col-md-12 col-12 p-3">
            <span class="title_header">{{ __('Profile') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12 pb-4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
