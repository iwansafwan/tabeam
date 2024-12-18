<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="card" style="border-radius:20px !important; padding:50px 50px 20px 50px !important; box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-12 col-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="border-bottom-input" placeholder="Type your email..." required>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div class="row mt-4">
                    <div class="col-md-12 col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="password" id="password" value="" class="border-bottom-input" placeholder="Type your password..." required>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 col-12">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn" style="min-width:140px !important; background:#01ad9d; color:white; border-radius:15px !important;">Login</button>
                            </div>
                        </div>
                        <div class="row justify-content-center my-4">
                            <div class="col-auto">OR</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a href="{{ route('register') }}" class="btn" style="min-width:140px !important; background:#01ad9d; color:white; border-radius:15px !important;">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
