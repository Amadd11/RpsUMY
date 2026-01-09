<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Components\Grid;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class TugasRelationManager extends RelationManager
{
    protected static string $relationship = 'tugas';

    protected static ?string $title = 'Tugas & Ujian';
    protected static ?string $modelLabel = 'Tugas & Ujian';
    protected static ?string $pluralModelLabel = 'Tugas & Ujian';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Dasar')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('judul_penilaian')
                                    ->label('Judul Penilaian')
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('jadwal_pelaksanaan')
                                    ->label('Jadwal Pelaksanaan')
                                    ->placeholder('Contoh: Minggu ke-5')
                                    ->columnSpan(1),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Detail Penilaian Utama')
                    ->schema([
                        RichEditor::make('sub_cpmk')
                            ->label('Sub-CPMK')
                            ->columnSpanFull(),

                        RichEditor::make('bentuk_penilaian')
                            ->label('Bentuk Penilaian')
                            ->columnSpanFull(),

                        RichEditor::make('deskripsi_penilaian')
                            ->label('Deskripsi Penilaian')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Metode dan Luaran')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                RichEditor::make('metode_penilaian')
                                    ->label('Metode Penilaian')
                                    ->columnSpanFull(),

                                RichEditor::make('bentuk_dan_format_luaran')
                                    ->label('Bentuk dan Format Luaran')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
                Section::make('Evaluasi dan Referensi')
                    ->schema([
                        RichEditor::make('indikator_kriteria_bobot')
                            ->label('Indikator, Kriteria, dan Bobot Penilaian')
                            ->columnSpanFull(),

                        RichEditor::make('pustaka')
                            ->label('Pustaka / Referensi')
                            ->columnSpanFull(),

                        RichEditor::make('lain_lain')
                            ->label('Lain-lain')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul_penilaian')
            ->columns([
                TextColumn::make('jadwal_pelaksanaan')
                    ->label('Week')
                    ->searchable(),
                TextColumn::make('judul_penilaian')
                    ->label('Judul Penilaian')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('bentuk_penilaian')
                    ->label('Bentuk Penilaian')
                    ->html()
                    ->searchable(),
                TextColumn::make('sub_cpmk')
                    ->label('Sub-CPMK')
                    ->limit(50)
                    ->html(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
