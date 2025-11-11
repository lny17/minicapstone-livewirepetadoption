<?php

use App\Livewire\AdoptationRequestCrud;
use App\Livewire\AdoptationsCrud;
use App\Livewire\AdoptersCrud;
use App\Livewire\Dashboard;
use App\Livewire\PetsCrud;
use App\Livewire\StaffsCrud;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dash', Dashboard::class)->name('myDashboard');
Route::get('/pets', PetsCrud::class)->name('pets.index');
Route::get('/adopters', AdoptersCrud::class)->name('adopters.index');
Route::get('/staffs', StaffsCrud::class)->name('staffs.index');
Route::get('/adoptations', AdoptationsCrud::class)->name('adoptations.index');
Route::get('/adoptationRequests', AdoptationRequestCrud::class)->name('adoptationReqests.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
