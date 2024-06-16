<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;

    public static ?string $title = 'Создать организацию';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role_id'] = User::Organization;

        return $data;
    }
}
