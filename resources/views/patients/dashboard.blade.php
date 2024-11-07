<title>Patient Dashboard</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Patient Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Display the logged-in patient's name -->
                    <h3 class="text-xl font-semibold mb-4">Welcome, {{ $patient->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">Here you can manage your appointments, view health records, and contact your therapist.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mt-4">
                    <h4 class="text-lg font-semibold mb-2">Patient Actions</h4>
                    <ul class="list-disc ml-5">
                        <li><a href="#"class="text-blue-600 hover:underline">Articles</a></li>
                        <li><a href="#" class="text-blue-600 hover:underline">Contact Therapist</a></li>
                        <li><a href="#" class="text-blue-600 hover:underline">View Health Records</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
