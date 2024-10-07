<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'subscription_id' => 'required|exists:payments,subscription_id',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Find the payment record based on subscription ID
        $payment = Payment::where('subscription_id', $validated['subscription_id'])->firstOrFail();

        // Handle the image upload
        if ($request->hasFile('proof')) {
            // Store the image in the 'proofs' directory inside the storage/app/public directory
            $path = $request->file('proof')->store('public/proofs');
            
            // Save the filename (path) in the payment record
            $payment->proof = Storage::url($path);
            $payment->status = 'pending'; // Set status to pending until admin approval
            $payment->save();
        }

        return redirect('/patient/my-subscriptions')->with('success', 'Payment proof uploaded successfully. Awaiting admin approval.');
    }
}
