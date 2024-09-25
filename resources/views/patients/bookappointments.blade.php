<title>Appointments</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Available Therapists') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto my-2">
        <h5 class="text-center text-5xl font-bold py-3">Available Therapists</h5>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 p-2 ">
            @foreach ($therapists as $therapist)
            {{-- Therapist Card --}}
            <div class="w-full bg-white border border-gray-200 rounded-lg p-5 shadow">

                <div class="flex flex-col items-center pb-10">

                    <img src="{{ asset('images/pp.png') }}" alt="image" class="w-24 h-24 mb-2.5 rounded-full shadow-lg">

                    <h5 class="mb-1 text-xl font-medium text-gray-900">
                        {{ $therapist->name }}
                    </h5>
                    <span class="text-sm text-gray-500">{{ $therapist->email }}</span>

                    {{-- Additional Data: Expertise and Ratings --}}
                    <p class="text-sm text-gray-700 mt-2">
                        <strong>Expertise:</strong> {{ $therapist->expertise }}
                    </p>
                    <p class="text-sm text-gray-700">
                        <strong>Ratings:</strong> {{ $therapist->ratings }} / 5
                    </p>
                    <div class="flex mt-4 space-x-3 md:mt-6 border-2 p-2 bg-slate-400 rounded-md">
                        <a href="{{ route('patients.therapist-details', $therapist->id) }}" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
