<x-guest-layout>
    <!-- Session Status -->
    <x-default.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-default.input-label for="employee_number" :value="__('Employee Number')" />
            <x-default.text-input id="employee_number" class="block mt-1 w-full" type="text" name="employee_number" :value="old('employee_number')" required autofocus autocomplete="username" />
            <x-default.input-error :messages="$errors->get('employee_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-default.input-label for="password" :value="__('Password')" />

            <x-default.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-default.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-default.primary-button class="btn btn-wide">
                {{ __('Log in') }}
            </x-default.primary-button>
        </div>
    </form>
</x-guest-layout>
