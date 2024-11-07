<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Dashboard') }}
                    </x-nav-link>

                    <!-- Dropdown for User Management -->
                    <div x-data="{ open: false }" class="relative mt-6 text-sm text-gray-600">
                        <button @click="open = !open" class="flex items-center space-x-1">
                            <span>{{ __('Account Management') }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg">
                            <x-nav-link :href="route('admin.patients')" :active="request()->routeIs('admin.patients')" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200">
                                {{ __('Patients') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.therapists')" :active="request()->routeIs('admin.therapists')" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200">
                                {{ __('Therapists') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <x-nav-link :href="route('admin.pending')" :active="request()->routeIs('admin.pending')">
                        {{ __('Manage Subscription') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.pending')" :active="request()->routeIs('admin.pending')">
                        {{ __('Manage Contents') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.reports')" :active="request()->routeIs('admin.reports')">
                        {{ __('View Reports') }}
                    </x-nav-link>
                </div>
            </div>

            @include('layouts.partials.user-settings') <!-- Include user settings dropdown -->
        </div>
    </div>
</nav>
