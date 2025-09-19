<?
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ConsultationController;

Route::middleware('auth')->post('/appointments', [AppointmentController::class, 'store']);
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/assign-vet', [AppointmentController::class, 'vets']);
Route::post('/appointments/assign-vet/{id}', [AppointmentController::class, 'assignVet']);
Route::patch('/appointments/{appointment}/status/{status}', [AppointmentController::class, 'updateStatus']);

Route::get('/users', [UserController::class, 'index']);
Route::patch('/users/{user}/activate', [UserController::class, 'activate']);
Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate']);
Route::get('/test', function() {
    return response()->json(['status' => 'ok']);
});

Route::get('/consultations', [ConsultationController::class, 'index']);