<?php

namespace App\Filament\Resources\Rps\Tables;

use App\Models\Rps;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class RpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.prodi.name')
                    ->label('Prodi')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('course.name')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('course.code')
                    ->label('Kode Course')
                    ->badge()
                    ->sortable(),
                TextColumn::make('course.semester')
                    ->label('Semester')
                    ->badge()
                    ->sortable(),
                TextColumn::make('dosen.name')
                    ->label('Dosen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tgl_penyusunan')
                    ->label('Tanggal Penyusunan')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status Data')
                    ->badge()
                    ->getStateUsing(function (Rps $record) {
                        $isComplete = $record->cpls->isNotEmpty() &&
                            $record->rencanas->isNotEmpty() &&
                            $record->cpmks->isNotEmpty();

                        return $isComplete ? 'Lengkap' : 'Belum Lengkap';
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Lengkap' => 'success',
                        'Belum Lengkap' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->html()
                    ->limit(50) // Truncate panjang
                    ->toggleable(isToggledHiddenByDefault: true),
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
