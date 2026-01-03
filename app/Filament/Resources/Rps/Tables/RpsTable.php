<?php

namespace App\Filament\Resources\Rps\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan nama mata kuliah, bukan ID
                TextColumn::make('course.name')
                    ->label('Mata Kuliah')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('dosen.name')
                    ->label('Dosen PJ')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->searchable(),

                TextColumn::make('dosens.name')
                    ->label('Penanggung Jawab')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y - H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y - H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
