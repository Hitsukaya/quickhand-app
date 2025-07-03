<?php

namespace App\Filament\Resources\AdApplicationResource\Pages;

use App\Filament\Resources\AdApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdApplications extends ListRecords
{
    protected static string $resource = AdApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
