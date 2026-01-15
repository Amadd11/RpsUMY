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
                TextInput::make('akreditasi')
                    ->placeholder('A / Unggul')
                    ->maxLength(20),

                Select::make('jenjang')
                    ->options([
                        'D3' => 'D3',
                        'S1' => 'S1',
                        'S2' => 'S2',
                    ]),

                TextInput::make('total_sks')
                    ->minValue(0)
                    ->numeric(),
                TextInput::make('total_semester')
                    ->minValue(0)
                    ->numeric(),
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
