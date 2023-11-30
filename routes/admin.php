<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware('auth')->group(function () {

    Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Dashboard.
    Route::get('/', function () {
        return redirect()->route('cars.index');
    });

    // Users.
    Route::resource('users', UsersController::class);

    // Cars.
    Route::put('cars/payment/{car}', [CarController::class, 'changeStatusPayment'])->name('cars.changeStatusPayment');
    Route::resource('cars', CarController::class);

    // Clients.
    Route::resource('clients', ClientController::class);

    // Languages.
    Route::resource('languages', LanguageController::class);

    // Translations.
    Route::resource('translations', TranslationsController::class);

    // Settings.
    Route::get('settings/{setting}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('settings/{setting}', [SettingController::class, 'update'])->name('setting.update');

    //Files
    Route::post('fm/upload-image', [FileController::class, 'uploadImage'])->name('files.uploadImage');
    Route::post('fm/upload-video', [FileController::class, 'uploadVideo'])->name('files.uploadVideo');
    Route::post('fm/upload-zip', [FileController::class, 'uploadZip'])->name('files.uploadZip');
    Route::post('fm/unzip', [FileController::class, 'unZip'])->name('files.unZip');
    Route::get('fm/check', [FileController::class, 'test'])->name('files.check');
    Route::post('fm/optimize', [FileController::class, 'optimizationFiles'])->name('files.optimize');

});
