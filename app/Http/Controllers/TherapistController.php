<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index()
    {
    return view('therapist.dashboard');
    }

}