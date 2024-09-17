<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use App\Mail\InvitationOrganization;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;

    public static ?string $title = 'Создать организацию';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Mail::to($data['email'])->send(new InvitationOrganization($data['name'], $data['email'], $data['password'], 'Karaterating'));

        $data['role_id'] = User::Organization;
        $data['password'] = Hash::make($data['password']);
        $data['ref_token'] = Str::uuid()->toString();

        return $data;
    }
}
