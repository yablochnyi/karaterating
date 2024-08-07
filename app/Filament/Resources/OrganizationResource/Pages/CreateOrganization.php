<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use App\Mail\InvitationOrganization;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;

    public static ?string $title = 'Создать организацию';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Mail::to($data['email'])->send(new InvitationOrganization($data['email'], $data['password'], 'Приглашение'));

        $data['role_id'] = User::Organization;
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}
