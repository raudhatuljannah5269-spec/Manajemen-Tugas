<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-100">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-xl border border-blue-200">

            <!-- Judul -->
            <h2 class="text-center text-3xl font-extrabold text-blue-600 mb-6 drop-shadow-sm">
                Selamat Datang 
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" class="text-blue-700" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" class="text-blue-700" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-blue-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            name="remember">
                        <span class="ms-2 text-sm text-blue-700">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex justify-center mt-4">
    <a href="{{ route('register') }}"
       class="text-blue-700 hover:text-blue-900 underline text-sm">
       Belum punya akun? Daftar di sini
    </a>
</div>


                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-500 hover:text-blue-700"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button
                        class="ms-3 bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 text-white px-6 py-2 rounded-xl">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
