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
