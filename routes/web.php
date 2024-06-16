<?php

use App\Http\Middleware\AuthCoach;
use App\Livewire\CoachStudent;
use App\Livewire\CoachTournament;
use App\Livewire\FilterRegion;
use App\Livewire\Login;
use App\Livewire\ManageTournament;
use App\Livewire\OrganizateTournament;
use App\Livewire\EditProfile;
use App\Livewire\Profile;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', FilterRegion::class)->name('filter.region');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('tournament/{id}/puli/list', \App\Livewire\PuliListStudent::class)->name('puli.list');

//auth
Route::get('/edit/profile', EditProfile::class)->name('edit.profile');

// student
Route::get('/profile', Profile::class)->name('profile');

// coach
Route::get('/coach/tournaments', CoachTournament::class)->name('coach.tournament')->middleware(AuthCoach::class);
Route::get('/coach/students', CoachStudent::class)->name('coach.student')->middleware(AuthCoach::class);
Route::get('/students/{id}', \App\Livewire\ViewStudentProfile::class)->name('students.show');


// organizator
Route::get('/manage/tournaments', ManageTournament::class)->name('manage.tournament');
Route::get('/manage/tournaments/{id}/coaches', OrganizateTournament::class)->name('organize.tournament');
Route::get('/manage/tournaments/{id}/puli', \App\Livewire\OrganizateTournamentPuli::class)->name('organize.tournament.puli');
Route::get('/manage/coach', \App\Livewire\OrganizateCoach::class)->name('organize.coach');
