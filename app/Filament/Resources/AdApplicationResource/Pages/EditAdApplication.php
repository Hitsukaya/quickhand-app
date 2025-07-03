<?php

namespace App\Filament\Resources\AdApplicationResource\Pages;

use App\Filament\Resources\AdApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdApplication extends EditRecord
{
    protected static string $resource = AdApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
