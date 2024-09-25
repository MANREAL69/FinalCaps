<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'datetime' => 'required|date',
            'description' => 'required|string|max:255',
            'therapist_id' => 'required|exists:users,id',
        ]);

        // Create a new appointment
        Appointment::create([
            'datetime' => $request->datetime,
            'description' => $request->description,
            'therapistID' => $request->therapist_id,
            'patientID' => Auth::id(), // therapist's ID
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect with success message
        return redirect()->route('patients.appointment')->with('success', 'Appointment successfully booked!');
    }

    public function cancelApp($appointmentID)
    {
        // Fetch the appointment using the provided appointment ID
        $appointment = Appointment::where('appointmentID', $appointmentID)
            ->where('patientID', Auth::id()) // Ensure the patient is the owner of the appointment
            ->first();

        // Check if the appointment exists
        if (!$appointment) {
            return redirect()->route('patients.appointment')->with('error', 'Appointment not found or you do not have permission to cancel this appointment.');
        }

        // Delete the appointment
        $appointment->delete();

        // Redirect with a success message
        return redirect()->route('patients.appointment')->with('success', 'Appointment successfully canceled!');
    }
}
