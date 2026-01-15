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
                    ->relationship(
                        name: 'prodi',
                        titleAttribute: 'name',
                        modifyQueryUsing: function ($query) {
                            $user = auth()->user();

                            // Admin fakultas → hanya prodi dalam fakultasnya
                            if ($user->hasRole('Admin Fakultas') && $user->fakultas_id) {
                                $query->where('fakultas_id', $user->fakultas_id);
                            }

                            // Admin prodi → hanya 1 prodi (punya dia)
                            if ($user->hasRole('Admin Prodi') && $user->prodi_id) {
                                $query->where('id', $user->prodi_id);
                            }
                        }
                    )
                    ->searchable()
                    ->preload()
                    ->default(fn() => auth()->user()->prodi_id)
                    ->disabled(fn() => auth()->user()->hasRole('Admin Prodi'))
                    ->dehydrated()
                    ->required()
            ]);
    }
}
