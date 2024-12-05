<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 flex items-center justify-center">
        <!-- Container for Flex layout -->
        <div class="flex w-full max-w-screen-xl rounded-lg shadow-lg">

            <!-- Image Section (50% width) -->
            <div class="w-1/2 bg-cover bg-center rounded-l-lg" style="background-image: url('images/reg_image.jpg');">
                <!-- Optional: Add a text or logo on the image if needed -->
            </div>

            <!-- Register Form Section (50% width) -->
            <div class="w-1/2 bg-white rounded-r-lg p-8 sm:p-12">

                <!-- Heading -->
                <div class="text-left mb-8">
                    <h1 class="text-3xl font-semibold text-gray-700">{{ __('Sign Up') }}</h1>
                </div>

                <!-- Logo Section Centered -->
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('images/logo_black.png') }}" alt="Logo" class="img-fluid" style="width: 250px; height: auto;">
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Input -->
                    <div class="mb-6">
                        <x-label for="name" value="{{ __('Name') }}" class="text-lg text-gray-700" />
                        <x-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <!-- Email Input -->
                    <div class="mb-6">
                        <x-label for="email" value="{{ __('Email') }}" class="text-lg text-gray-700" />
                        <x-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <x-label for="password" value="{{ __('Password') }}" class="text-lg text-gray-700" />
                        <x-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-6">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-lg text-gray-700" />
                        <x-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-4 text-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <!-- Terms and Privacy Policy Checkbox -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-6">
                            <x-label for="terms" class="text-sm text-gray-600">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
                                    <div class="ml-2 text-sm">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <!-- Footer Links & Button -->
                    <div class="flex items-center justify-between mt-6">
                        <a class="underline text-sm text-gray-600 hover:text-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-6 py-3 text-lg font-medium transition ease-in-out duration-300">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
