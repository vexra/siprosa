<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 shadow-md overflow-hidden sm:rounded-lg" style="background-color: #E6F0FF;">
        <h2 class="text-center text-xl font-bold text-gray-800 mb-6">Masuk Akun</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center justify-center mt-6">
                <x-primary-button class="w-full justify-center">
                    {{ __('Masuk') }}
                </x-primary-button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif

                <span class="mt-4 text-sm text-gray-600">Belum punya akun?
                    <a class="underline text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        Daftar di sini
                    </a>
                </span>
            </div>
        </form>
    </div>
</x-guest-layout>