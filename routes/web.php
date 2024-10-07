<?php
use App\Http\Livewire\Users;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Chat\Chat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/select-register', [AdminController::class, 'selectRegister'])->name('view.select-register');

Route::get('/register/patient', [PatientController::class, 'showRegistrationForm'])->name('patient.register');
Route::get('/register/therapist', [TherapistController::class, 'showRegistrationForm'])->name('therapist.register');

Route::post('/register/patient', [RegisteredUserController::class, 'storePatient'])->name('patient.store');
Route::post('/register/therapist', [RegisteredUserController::class, 'storeTherapist'])->name('therapist.store');
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'therapist') {
        return redirect()->route('therapist.dashboard');
    } elseif ($user->role === 'patient') {
        return redirect()->route('patients.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        abort(403, 'Unauthorized');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard route
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Therapist dashboard route
Route::middleware(['auth', 'role:therapist'])->get('/therapist/dashboard', [TherapistController::class, 'index'])->name('therapist.dashboard');

// Patient dashboard route
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientController::class, 'index'])->name('patients.dashboard');

// Patient view appointment
Route::middleware(['auth', 'role:patient'])->get('/patient/appointment', [PatientController::class, 'viewApp'])->name('patients.appointment');

// Patient view chats
Route::middleware(['auth', 'role:patient'])->get('/patient/chat', [ChatController::class, 'index'])->name('chat.index');
Route::middleware(['auth', 'role:patient'])->get('/patient/chat/create', [ChatController::class, 'create'])->name('chat.create');

Route::middleware(['auth', 'role:patient'])->get('/patient/chat/{id}', [ChatController::class, 'show'])->name('chat.show');

// Patient cancel appointment
Route::middleware(['auth', 'role:patient'])->post('/patient/appointment/{appointmentID}', [AppointmentController::class, 'cancelApp'])->name('patients.cancelApp');

// Patient book appointment route
Route::middleware(['auth', 'role:patient'])->get('/patient/bookappointment', [PatientController::class, 'appIndex'])->name('patients.bookappointments');

// Patient appointment details
Route::middleware(['auth', 'role:patient'])->get('/patient/bookappointment/{id}', [PatientController::class, 'appDetails'])->name('patients.therapist-details');

// Patient store appointment
Route::post('patients/bookappointment/store', [AppointmentController::class, 'store'])->name('appointments.store');

// Therapist appointment
Route::middleware(['auth', 'role:therapist'])->get('/therapist/appointment', [TherapistController::class, 'appIndex'])->name('therapist.appointment');

// Authentication routes
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth', 'role:patient'])->group(function () {
    // Livewire chat routes
    Route::get('/patient/chat', Index::class)->name('chat.index');
    Route::get('/patient/chat/create', [ChatController::class, 'create'])->name('chat.create');
    Route::get('/patient/chat/{id}', [ChatController::class, 'show'])->name('chat.show'); // Renamed
    Route::get('/patient/chat/{query}', Chat::class)->name('chat.show.livewire'); // Renamed
    Route::get('/patient/users', Users::class)->name('chat.users');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Additional routes
require __DIR__.'/auth.php';
