<?php

namespace App\Filament\Clusters;

use App\Models\User;
use Filament\Clusters\Cluster;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Support\Facades\Auth;

class Trener extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user()->role_id == User::Student || auth()->user()->role_id == User::Admin ) {
            return false;
        } else {
            return true;
        }
    }
    public static function getNavigationLabel(): string
    {
        return Auth::user()->role_id == User::Organization ? 'Тренеры и ученики' : 'Ученики';
    }
}
