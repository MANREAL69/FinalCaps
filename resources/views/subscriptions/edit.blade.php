<title>Update Subscription</title>
<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Subscription</h1>
        <form action="{{ url('/patient/subscriptions/' . $subscription->id) }}" method="POST" class="bg-white shadow rounded-lg p-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="service_name" class="block text-sm font-medium">Service Name:</label>
                <input type="text" name="service_name" value="{{ $subscription->service_name }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium">Start Date:</label>
                <input type="datetime-local" name="start_date" value="{{ $subscription->start_date }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium">End Date (optional):</label>
                <input type="datetime-local" name="end_date" value="{{ $subscription->end_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium">Status:</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="canceled" {{ $subscription->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</x-app-layout>
