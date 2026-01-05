<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('prodi_id')
                    ->label('Program Studi')
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
                    ->required(),
                TextInput::make('judul')
                    ->label('Judul Dokumen')
                    ->placeholder('Contoh: Panduan Akademik 2024')
                    ->maxLength(255)
                    ->required(),
                FileUpload::make('file')
                    ->label('File PDF')
                    ->disk('public')
                    ->directory('dokumen-prodi')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(5120) // 5 MB
                    ->required(),
            ]);
    }
}
