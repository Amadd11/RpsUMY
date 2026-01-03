<?php

namespace App\Filament\Resources\Fakultas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Laravel\Pail\File;

class FakultasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Fakultas')
                    ->maxLength(255)
                    ->required(),
                RichEditor::make('deskripsi')
                    ->label('Deskripsi Fakultas')
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('fakultas-logo')
                    ->imageEditor()
                    ->avatar()
                    ->required()
                    ->label('Logo Fakultas')
            ]);
    }
}
