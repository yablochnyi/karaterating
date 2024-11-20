<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Agreement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.agreement';
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'agreement-doc/{id}';

    public $agreement;

    public function getTitle(): string|Htmlable
    {
        return '';
    }

    public function mount($id)
    {
        $this->agreement = \App\Models\Agreement::find($id);
    }
}
