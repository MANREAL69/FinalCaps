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
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ArticleController;

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
Route::middleware(['auth', 'role:admin'])->get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::middleware(['auth', 'role:admin'])->get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
Route::middleware(['auth', 'role:admin'])->get('/admin/therapists', [AdminController::class, 'therapists'])->name('admin.therapists');
Route::middleware(['auth', 'role:admin'])->get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');
Route::middleware(['auth', 'role:admin'])->get('/admin/subscription', [SubscriptionController::class, 'pendingPayments'])->name('admin.pending');
Route::middleware(['auth', 'role:admin'])->post('/admin/subscription/{subscriptionId}', [SubscriptionController::class, 'approvePayment'])->name('admin.subscriptions.approve');

// Admin article management routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/admin/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/admin/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Therapist dashboard route
Route::middleware(['auth', 'role:therapist'])->get('/therapist/dashboard', [TherapistController::class, 'index'])->name('therapist.dashboard');

Route::get('/patient/subscriptions', [SubscriptionController::class, 'subPlan'])->name('subscriptions.plan'); // View subscriptions
Route::get('/patient/my-subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index'); // View subscriptions
Route::get('/patient/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');  // Form to subscribe
Route::post('/patient/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');     // Store subscription
Route::get('/patient/subscriptions/{id}/edit', [SubscriptionController::class, 'edit'])->name('subscriptions.edit');  // Edit subscription
Route::post('/patient/subscriptions/{id}/update', [SubscriptionController::class, 'update'])->name('subscriptions.update');    // Update subscription
Route::delete('/patient/subscriptions/{id}', [SubscriptionController::class, 'destroy']); // Cancel subscription
Route::get('/patient/subscriptions/payment', [SubscriptionController::class, 'payment'])->name('subscriptions.payment');
Route::post('/patient/subscriptions/payments/store', [PaymentController::class, 'store'])->name('payments.store');

// Patient dashboard route
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientController::class, 'index'])->name('patients.dashboard');

// Patient view appointment
Route::middleware(['auth', 'role:patient'])->get('/patient/appointment', [PatientController::class, 'viewApp'])->name('patients.appointment');
Route::middleware(['auth', 'role:admin'])->post('/admin/patients/{id}/deactivate', [PatientController::class, 'deactivate'])->name('patients.deactivate');
Route::middleware(['auth', 'role:admin'])->post('/admin/therapist/{id}/deactivate', [TherapistController::class, 'deactivate'])->name('therapist.deactivate');

Route::middleware(['auth', 'role:admin'])->post('/admin/patients/{id}/activate', [PatientController::class, 'activate'])->name('patients.activate');
Route::middleware(['auth', 'role:admin'])->post('/admin/therapist/{id}/activate', [TherapistController::class, 'activate'])->name('therapist.activate');

// Patient view chats
Route::middleware(['auth', 'role:patient'])->get('/patient/chat', [ChatController::class, 'index'])->name('chat.index');
Route::middleware(['auth', 'role:patient'])->get('/patient/chat/create', [ChatController::class, 'create'])->name('chat.create');

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
Route::middleware(['auth', 'role:therapist'])->post('/therapist/appointment/{appointmentID}/approve', [TherapistController::class, 'approveApp'])->name('therapist.approve');
Route::middleware(['auth', 'role:therapist'])->post('/therapist/appointment/{appointmentID}/disapprove', [TherapistController::class, 'disapproveApp'])->name('therapist.disapprove');

// Patient routes to view articles
Route::get('/articles', [ArticleController::class, 'showForPatients'])->name('articles.showForPatients');

// Authentication routes
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth', 'role:patient'])->group(function () {
    // Livewire chat routes
    Route::get('/patient/chat', Index::class)->name('chat.index');
    Route::get('/patient/chat/create', [ChatController::class, 'create'])->name('chat.create');
    Route::get('/patient/chat/conversation/{id}', [ChatController::class, 'show'])->name('chat.show'); // Renamed
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
