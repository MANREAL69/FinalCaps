<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;


class PatientController extends Controller
{
    //
    public function index()
    {
        return view('patients.dashboard');
    }

    public function viewApp()
    {
        // Get the currently authenticated patient
        $patient = Auth::user();

        // Fetch appointments for the authenticated patient
        $appointments = Appointment::where('patientID', $patient->id)->get();

        // Pass appointments to the view
        return view('patients.viewappointments', compact('appointments'));
    }

    public function appIndex() {
        $therapists = User::where('role', 'therapist')->get();
        // Pass therapists to the view
        return view('patients.bookappointments', compact('therapists'));
    }

    public function appDetails($id)
    {
        // Fetch the therapist by ID
        $therapist = User::findOrFail($id);

        // Pass the therapist to the view
        return view('patients.therapist-details', compact('therapist'));
    }
}
