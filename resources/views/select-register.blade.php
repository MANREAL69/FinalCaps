<x-guest-layout>
    <div class="flex flex-col items-center justify-center dark:bg-gray-900 h-96 w-full">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200 -mt-4">Register As:</h1>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-10 w-full max-w-md border-2">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('patient.register') }}" class="font-bold flex border-2 py-3 justify-center bg-red-500 text-black rounded-lg hover:bg-red-300 transition duration-200">
                    Register as Patient
                </a>
                <a href="{{ route('therapist.register') }}" class="font-bold flex border-2 py-3 justify-center bg-blue-500 text-black rounded-lg hover:bg-blue-300 transition duration-200">
                    Register as Therapist
                </a>
            </div>
        </div>
        <div class="py-2 flex">
            <a href="{{ route('login') }}" class="font-bold text-base pr-60 pt-2 mt-2 underline underline-offset-4 text-sky-600">
                Already signed up?
            </a>
        </div>
    </div>
</x-guest-layout>
