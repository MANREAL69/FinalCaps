<title>Subscription</title>
<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Subscriptions</h1>
        <a href="{{ route('subscriptions.plan') }}" class="text-blue-500 hover:underline">Subscribe to a Service</a>
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        @foreach ($subscriptions as $subscription)
            <div class="bg-white shadow rounded-lg p-4 mt-4">
                <h2 class="text-xl font-semibold">{{ $subscription->service_name }}</h2>
                <p><strong>Start Date:</strong> {{ $subscription->start_date }}</p>
                <p><strong>End Date:</strong> {{ $subscription->end_date }}</p>
                <p><strong>Status:</strong> {{ $subscription->status }}</p>
                <a href="{{ url('/patient/subscriptions/' . $subscription->id . '/edit') }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ url('/patient/subscriptions/' . $subscription->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Cancel</button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
