<?php

namespace App\Filament\Resources\Prodis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class ProdiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('fakultas_id')
                    ->label('Fakultas')
                    ->relationship('fakultas', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                TextInput::make('name')
                    ->label('Nama Prodi')
                    ->maxLength(255)
                    ->required(),
                RichEditor::make('deskripsi')
                    ->label('Deskripsi Prodi')
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('prodi-logo')
                    ->imageEditor()
                    ->avatar()
                    ->required()
                    ->label('Logo Fakultas'),
            ]);
    }
}
