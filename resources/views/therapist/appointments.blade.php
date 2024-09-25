<title>Appointment</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h3 class="text-lg font-semibold mb-4">Patient Appointments</h3>

            @if ($appointments->isEmpty())
                <p>No appointments found.</p>
            @else
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Patient Name</th>
                            <th class="px-4 py-2 text-left">Appointment Date</th>
                            <th class="px-4 py-2 text-left">Description</th>
                            <th class="px-4 py-2 text-left">Created At</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-left">{{ $appointment->appointmentID }}</td>
                                <td class="px-4 py-2 text-left">{{ $appointment->patient->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-left">{{ $appointment->datetime }}</td>
                                <td class="px-4 py-2 text-left">{{ $appointment->description }}</td>
                                <td class="px-4 py-2 text-left">{{ $appointment->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 text-left">
                                    <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve</button>
                                    <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Disapprove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
