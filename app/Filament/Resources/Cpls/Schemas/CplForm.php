<?php

namespace App\Filament\Resources\Cpls\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CplForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('prodi_id')
                    ->label('Prodi')
                    ->relationship('prodi', 'name')
                    ->searchable()
                    ->preload()
                    ->default(fn() => auth()->user()->prodi_id)
                    ->required(),
                TextInput::make('code')
                    ->label('Kode CPL')
                    ->required(),
                TextInput::make('taksonomi')
                    ->label('Taksonomi'),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                ColorPicker::make('bg_color')
                    ->label('Warna CPL')
                    ->default('#16a34a'),
            ]);
    }
}
