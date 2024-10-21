<title>Update Subscription</title>
<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Subscription</h1>
        <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST" class="bg-white shadow rounded-lg p-4">
            @csrf
            <div class="mb-4">
                <label for="service_name" class="block text-sm font-medium">Service Name:</label>
                <input type="text" name="service_name" id="service_name" value="{{ old('service_name', $subscription->service_name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                @error('service_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium">Start Date:</label>
                <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($subscription->start_date)->format('Y-m-d\TH:i')) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                @error('start_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium">End Date (optional):</label>
                <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $subscription->end_date ? \Carbon\Carbon::parse($subscription->end_date)->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                @error('end_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</x-app-layout>
