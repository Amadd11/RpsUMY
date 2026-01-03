<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Mata Kuliah')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('name_en')
                    ->label('Course Name (English)')
                    ->required()
                    ->maxLength(255),
                TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->maxLength(50)
                    ->placeholder('contoh: MRS102'),
                TextInput::make('sks')
                    ->label('SKS')
                    ->numeric()
                    ->required()
                    ->placeholder('3'),
                TextInput::make('semester')
                    ->label('Semester')
                    ->numeric()
                    ->required()
                    ->placeholder('1'),
                Select::make('prodi_id')
                    ->label('Prodi')
                    ->relationship('prodi', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
