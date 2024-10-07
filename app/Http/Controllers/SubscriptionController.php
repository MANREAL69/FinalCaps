<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    // List all subscriptions
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('subscriptions.index', compact('subscriptions'));
    }

    // Show form to subscribe to a service
    public function create()
    {
        return view('subscriptions.create');
    }

    public function subPlan() {
        return view('subscriptions.plan');
    }

    public function payment(Request $request)
    {
        $subscription_id = $request->query('subscription_id');
        $price = $request->query('price');
        $payment_method = $request->query('payment_method');

        // Pass these variables to the view
        return view('subscriptions.payment', compact('subscription_id', 'price', 'payment_method'));
    }

    // Store a new subscription
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payment_method' => 'required|string|in:gcash,maya,credit_card,paypal',
            'price' => 'required|numeric|min:1|max:10000',
        ]);

        // Create the subscription
        $subscription = Subscription::create(array_merge($validated, [
            'patient_id' => auth()->id(),
            'status' => 'pending' // Set the initial status to pending
        ]));

        Payment::create([
            'subscription_id' => $subscription->id,
            'amount' => $validated['price'], // Set the amount accordingly
            'payment_method' => $validated['payment_method'],
            'transaction_id' => null, // This can be generated or updated after payment is processed
            'status' => 'pending',
            'proof' => null,
        ]);
        

        // Redirect to the payment page with subscription details
        return redirect()->route('subscriptions.payment', [
            'subscription_id' => $subscription->id,
            'price' => request('price'),
            'payment_method' => request('payment_method')
        ])->with('success', 'Subscription created successfully. Proceed to payment.');
    }

    // Show form to edit a subscription
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscriptions.edit', compact('subscription'));
    }

    // Update an existing subscription
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:pending,active,expired,canceled',
            'payment_method' => 'required|string|in:gcash,maya,credit_card,paypal', 
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->update($validated);

        return redirect('/patient/subscriptions')->with('success', 'Subscription updated successfully.');
    }
    
    

    // Cancel/Delete a subscription
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect('/subscriptions')->with('success', 'Subscription canceled successfully.');
    }
}
