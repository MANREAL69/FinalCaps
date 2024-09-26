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

                    <!-- Add more admin-specific links here -->
                    <x-nav-link>
                        {{ __('Manage Users') }}
                    </x-nav-link>

                    <x-nav-link>
                        {{ __('View Reports') }}
                    </x-nav-link>
                </div>
            </div>

            @include('layouts.partials.user-settings') <!-- Include user settings dropdown -->
        </div>
    </div>
</nav>
