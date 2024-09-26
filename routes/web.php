<?php
use App\Http\Livewire\Users;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Chat\Chat;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'therapist') {
        return redirect()->route('therapist.dashboard');
    } elseif ($user->role === 'patient') {
        return redirect()->route('patients.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
     else {
        abort(403, 'Unauthorized');
    }
})->middleware(['auth', 'verified'])->name('dashboard');
// Admin dashboard route
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Therapist dashboard route
Route::middleware(['auth', 'role:therapist'])->get('/therapist/dashboard', [TherapistController::class, 'index'])->name('therapist.dashboard');

// Patient dashboard route
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientController::class, 'index'])->name('patients.dashboard');

    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    Route::middleware('auth')->group(function (){
        Route::get('/chat',Index::class)->name('chat.index');
        Route::get('/chat/{query}',Chat::class)->name('chat');
        Route::get('/users',Users::class)->name('users');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Additional routes
require __DIR__.'/auth.php';
