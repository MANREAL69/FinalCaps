<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    public function index()
    {
        return view('therapist.dashboard');
    }

    public function appIndex()
    {
        // Fetch the appointments where the logged-in therapist is assigned
        $appointments = Appointment::where('therapistID', Auth::id())->with('patient')->get();

        // Pass appointments to the view
        return view('therapist.appointments', compact('appointments'));
    }

    public function showRegistrationForm() {
        return view('therapist.register');
    }

}
