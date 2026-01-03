<?php

namespace App\Filament\Resources\Cpls\Pages;

use App\Filament\Resources\Cpls\CplResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCpls extends ListRecords
{
    protected static string $resource = CplResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
