<?php

use App\Http\Livewire\CreateUser;
use App\Http\Livewire\CreateRole;
use App\Http\Livewire\ShowBooking;
use App\Http\Livewire\CreateBooking;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CreateSchedule;
use App\Http\Livewire\CreatePermission;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SystemRoleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UnavailabilityController;
use App\Http\Livewire\CreateScheduleUnavailability;
use App\Http\Controllers\SystemPermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/bookings/create', CreateBooking::class);
Route::get('/bookings/{appointment:uuid}', ShowBooking::class)->name('bookings.show');
Route::resource('services', ServiceController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('users', UserController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('unavailabilities', UnavailabilityController::class);
Route::resource('schedules', ScheduleController::class);
Route::get('employees/schedules/create', CreateSchedule::class)->name('employees.schedules.create');
Route::get('employees/unavailabilities/create', CreateScheduleUnavailability::class)->name('employees.unavailabilities.create');
Route::get('manage/users/create', CreateUser::class)->name('manage.users.create');
Route::get('manage/roles', [SystemRoleController::class, 'index'])->name('manage.roles.index');
Route::get('manage/roles/create', CreateRole::class)->name('manage.roles.create');
Route::get('manage/permissions', [SystemPermissionController::class, 'index'])->name('manage.permissions.index');
Route::get('manage/permissions/create', CreatePermission::class)->name('manage.permissions.create');

require __DIR__ . '/auth.php';
