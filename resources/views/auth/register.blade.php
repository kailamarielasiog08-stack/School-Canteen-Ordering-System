<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Account</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Join us and start ordering today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="group">
            <x-input-label for="name" :value="__('Name')" class="group-focus-within:text-indigo-600 transition-colors" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-6 group">
            <x-input-label for="email" :value="__('Email')" class="group-focus-within:text-indigo-600 transition-colors" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6 group">
            <x-input-label for="password" :value="__('Password')" class="group-focus-within:text-indigo-600 transition-colors" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6 group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="group-focus-within:text-indigo-600 transition-colors" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
