<?php

// use NewPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\NewPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which    
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// route auth user and admin
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout')->middleware('jwt.verify');
Route::post('/password', App\Http\Controllers\Api\PasswordController::class)->name('password')->middleware('jwt.verify');
Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('jwt.verify');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('jwt.verify');
Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);
// route user
Route::controller(ProfileController::class)->group(function(){
    Route::get('profile/show', 'show')->middleware('jwt.verify');
    Route::post('profile/store_profile', 'store_profile')->middleware('jwt.verify');
    Route::post('profile/update_profile', 'update_profile')->middleware('jwt.verify');
    Route::post('profile/store_file', 'store_file')->middleware('jwt.verify');
    Route::get('profile/show_file/{filename}', 'show_file');
    Route::post('profile/store', 'store');
});
// route admin
Route::controller(AdminController::class)->group(function(){
    Route::get('admin/show_all', 'show_all')->middleware(['jwt.verify','admin']);
    Route::get('admin/show_auser/{id}', 'show_auser')->middleware(['jwt.verify','admin']);
    Route::post('admin/status_aktif/{id}', 'status_aktif')->middleware(['jwt.verify','admin']);
    Route::post('admin/validation_status/{id}', 'validation_status')->middleware(['jwt.verify','admin']);
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['middleware' => 'jwt.verify'], function () {
//     Route::get('/profile', function show());
// });
// Route::middleware('jwt.verify')->get('/profile', [App\Http\Controllers\Api\ProfileController::class, 'show']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
// Route::apiResource('/profiles', App\Http\Controllers\Api\ProfileController::class)->middleware('jwt.verify');
// Route::get('/peserta/{id?}', App\Http\Controllers\Api\PesertaController::class)->name('show');

/**
 * route "/login"
 * @method "POST"
 */


/**
 * route "/user"
 * @method "GET"
 */
// Route::middleware('auth:api')->get('/user/{id}/profiles', function (Request $request, $id) {
//     return $request->user();
// });
/**
 * route "/logout"
 * @method "POST"
 */
