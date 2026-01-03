<?php

namespace App\Filament\Resources\Rps\Pages;

use App\Filament\Resources\Rps\RpsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRps extends ListRecords
{
    protected static string $resource = RpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
