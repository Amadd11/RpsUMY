<?php

namespace App\Filament\Resources\Rps\Pages;

use App\Filament\Resources\Rps\RpsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRps extends EditRecord
{
    protected static string $resource = RpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
