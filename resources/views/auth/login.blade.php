<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 flex items-center justify-center">
        <!-- Container for Flex layout -->
        <div class="flex w-full max-w-screen-xl rounded-lg shadow-lg">

            <!-- Image Section (50% width) -->
            <div class="w-1/2 bg-cover bg-center rounded-l-lg" style="background-image: url('images/login_image.jpg');">
                <!-- Optional: Add a text or logo on the image if needed -->
            </div>

            <!-- Login Form Section (50% width) -->
            <div class="w-1/2 bg-white rounded-r-lg p-8 sm:p-12">

                <!-- Heading -->
                <div class="text-left mb-8">
                    <h1 class="text-3xl font-semibold text-gray-700">{{ __('Sign In') }}</h1>
                </div>

                <!-- Logo Section Centered -->
                <div class="flex justify-center mb-8">
                    <x-authentication-card-logo />
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-6">
                        <x-label for="email" value="{{ __('Email') }}" class="text-lg text-gray-700" />
                        <x-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <x-label for="password" value="{{ __('Password') }}" class="text-lg text-gray-700" />
                        <x-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Footer Links & Button -->
                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-6 py-3 text-lg font-medium transition ease-in-out duration-300">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            {{ __('Sign Up') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
