<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Prodi;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->required(),
                Select::make('fakultas_id')
                    ->relationship('fakultas', 'name')
                    ->label('Fakultas')
                    ->preload()
                    ->searchable()
                    ->visible(fn() => auth()->user()->hasRole('super_admin'))
                    ->required()
                    ->reactive(),

                Select::make('prodi_id')
                    ->label('Program Studi')
                    ->preload()
                    ->searchable()
                    ->visible(fn() => auth()->user()->hasAnyRole(['super_admin', 'Admin Fakultas']))
                    ->options(function (callable $get) {
                        $user = auth()->user();

                        // Admin Fakultas → hanya prodi dari fakultasnya
                        if ($user->hasRole('Admin Fakultas')) {
                            return Prodi::where('fakultas_id', $user->fakultas_id)
                                ->orderBy('name')
                                ->pluck('name', 'id');
                        }

                        // SuperAdmin → prodi menyesuaikan fakultas yang dipilih
                        if ($fakultasId = $get('fakultas_id')) {
                            return Prodi::where('fakultas_id', $fakultasId)
                                ->orderBy('name')
                                ->pluck('name', 'id');
                        }

                        return [];
                    })
                    ->reactive()
            ]);
    }
}
