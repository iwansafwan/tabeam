<x-guest-layout>
    
    <div class="card" style="border-radius:20px !important; padding:30px 30px 10px 30px !important; box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="row my-2">
                    <div class="col-md-12 col-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" style="border-radius:15px !important;" placeholder="Type your name..." required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row my-2">
                    <div class="col-md-12 col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" style="border-radius:15px !important;" placeholder="Type your email..." required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div class="row my-2">
                    <div class="col-md-12 col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" style="border-radius:15px !important;" placeholder="Type your password..." required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                
                <div class="row my-2">
                    <div class="col-md-12 col-12">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" style="border-radius:15px !important;" placeholder="Type your password confirmation..." required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                
                <!-- Contact -->
                <div class="row my-2">
                    <div class="col-md-12 col-12">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" class="form-control" style="border-radius:15px !important;" placeholder="Type your contact number..." required>
                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 col-12">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn" style="min-width:140px !important; background:#01ad9d; color:white; border-radius:15px !important;">Sign Up</button>
                            </div>
                        </div>
                        <div class="row justify-content-center my-2">
                            <div class="col-auto">OR</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

</x-guest-layout>
