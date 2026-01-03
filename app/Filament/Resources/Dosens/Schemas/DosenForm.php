<?php

namespace App\Filament\Resources\Dosens\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;

class DosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Dosen')
                    ->maxLength(255)
                    ->required(),
                Select::make('prodi_id')
                    ->label('Program Studi')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->default(
                        fn() => auth()->user()->hasRole('Admin Prodi')
                            ? auth()->user()->prodi_id
                            : null
                    )
                    ->disabled(fn() => auth()->user()->hasRole('Admin Prodi'))
                    ->relationship(
                        name: 'prodi',
                        titleAttribute: 'name',
                    )
            ]);
    }
}
