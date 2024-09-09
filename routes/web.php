<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\AuthCoach;
use App\Http\Middleware\AuthOrganizator;
use App\Livewire\CoachStudent;
use App\Livewire\CoachTournament;
use App\Livewire\FilterRegion;
use App\Livewire\Login;
use App\Livewire\ManageTournament;
use App\Livewire\OrganizateCoach;
use App\Livewire\OrganizatePuliList;
use App\Livewire\OrganizateTournament;
use App\Livewire\EditProfile;
use App\Livewire\OrganizateTournamentPuli;
use App\Livewire\OrganizateTournamentPuliStudent;
use App\Livewire\Profile;
use App\Livewire\PuliListStudent;
use App\Livewire\Register;
use App\Livewire\TemplateList;
use App\Livewire\ViewStudentProfile;
use App\Livewire\ViewTrenerShow;
use Illuminate\Support\Facades\Route;

Route::get('/', FilterRegion::class)->name('filter.region');
Route::get('/register', Register::class)->name('register')->middleware(Auth::class);
Route::get('/login', Login::class)->name('login')->middleware(Auth::class);
Route::get('tournament/{id}/puli/list', PuliListStudent::class)->name('puli.list');

//auth
Route::get('/edit/profile', EditProfile::class)->name('edit.profile')->middleware(Auth::class);

// student
Route::get('/profile', Profile::class)->name('profile')->middleware(Auth::class);

// coach
Route::get('/coach/tournaments', CoachTournament::class)->name('coach.tournament')->middleware(AuthCoach::class);
Route::get('/coach/students', CoachStudent::class)->name('coach.student')->middleware(AuthCoach::class);
Route::get('/students/{id}', ViewStudentProfile::class)->name('students.show');
Route::get('/coach/{id}', ViewTrenerShow::class)->name('coach.show')->middleware(AuthOrganizator::class);


// organizator
Route::get('/manage/tournaments/generated/puli/{id}', OrganizateTournamentPuliStudent::class)->name('organize.tournament.generated.puli')->middleware(AuthOrganizator::class);

Route::get('/manage/tournaments', ManageTournament::class)->name('manage.tournament')->middleware(AuthOrganizator::class);
Route::get('/manage/tournaments/{id}/coaches', OrganizateTournament::class)->name('organize.tournament')->middleware(AuthOrganizator::class);
Route::get('/manage/tournaments/{id}/puli', OrganizateTournamentPuli::class)->name('organize.tournament.puli')->middleware(AuthOrganizator::class);
Route::get('/manage/coach', OrganizateCoach::class)->name('organize.coach')->middleware(AuthOrganizator::class);
Route::get('/manage/tournament/{id}/puli/list', OrganizatePuliList::class)->name('organize.tournament.puli.list')->middleware(AuthOrganizator::class);

