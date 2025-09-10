<?
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::patch('/users/{user}/activate', [UserController::class, 'activate']);
Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate']);
Route::get('/test', function() {
    return response()->json(['status' => 'ok']);
});
