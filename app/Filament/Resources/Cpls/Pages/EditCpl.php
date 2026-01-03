<?php

namespace App\Filament\Resources\Cpls\Pages;

use App\Filament\Resources\Cpls\CplResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCpl extends EditRecord
{
    protected static string $resource = CplResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
