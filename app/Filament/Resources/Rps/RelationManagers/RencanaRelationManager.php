<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use App\Models\Rencana;
use App\Models\Subcpmk;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class RencanaRelationManager extends RelationManager
{
    protected static string $relationship = 'rencanas';

    protected static ?string $title = 'Rencana Pembelajaran';
    protected static ?string $modelLabel = 'Rencana';
    protected static ?string $pluralModelLabel = 'Rencana';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->description('Tentukan pertemuan minggu ke berapa dan Sub-CPMK yang ingin dicapai.')
                    ->schema([
                        TextInput::make('week')
                            ->label('Minggu ke-')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(16)
                            ->required(),
                        Select::make('subcpmk_id')
                            ->label('Sub-CPMK')
                            ->required()
                            ->options(function (RelationManager $livewire, ?Model $record) {
                                // 1. Ambil owner record (RPS)
                                $rps = $livewire->getOwnerRecord();

                                // 2. Cari ID Sub-CPMK yang sudah digunakan di RPS ini (agar tidak duplikat)
                                // Jika sedang EDIT ($record ada), kecualikan ID rencana saat ini agar tetap muncul di opsi
                                $usedSubCpmkIds = Rencana::where('rps_id', $rps->id)
                                    ->when($record, fn($query) => $query->where('id', '!=', $record->id))
                                    ->pluck('subcpmk_id')
                                    ->filter()
                                    ->toArray();

                                // 3. Gunakan relasi langsung dari model RPS
                                // Ini akan mengambil semua Sub-CPMK yang terhubung dengan RPS ini
                                return $rps->subCpmks()
                                    ->whereNotIn('subcpmks.id', $usedSubCpmkIds)
                                    ->orderBy('code')
                                    ->pluck('code', 'subcpmks.id');
                            })
                            ->required()
                            ->searchable()
                            ->placeholder('Pilih Sub-CPMK dari RPS ini...'),

                    ]),

                Section::make('Detail Penilaian')
                    ->schema([
                        RichEditor::make('indikator')
                            ->label('Indikator ')
                            ->columnSpanFull(),
                        RichEditor::make('kriteria_teknik')
                            ->label('Kriteria dan Teknik')
                            ->columnSpanFull(),
                    ]),

                Section::make('Bentuk/ Strategi Pembelajaran (Metode & Tugas)')
                    ->schema([
                        RichEditor::make('luring')
                            ->label('Luring')
                            ->columnSpanFull(),
                        RichEditor::make('daring')
                            ->label('Daring')
                            ->columnSpanFull(),
                    ]),

                Section::make('Materi Pembelajaran')
                    ->schema([
                        RichEditor::make('materi_pembelajaran')
                            ->label('Detail Materi Pembelajaran (Pokok Bahasan)')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Bobot')
                    ->schema([
                        TextInput::make('bobot')
                            ->label('Bobot Penilaian (%)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),
                    ]),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('week')
            ->columns([
                TextColumn::make('week')
                    ->label('Minggu')
                    ->sortable(),

                TextColumn::make('subCpmk.code')
                    ->label('Sub-CPMK')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('materi_pembelajaran')
                    ->label('Materi Pembelajaran')
                    ->limit(250)
                    ->html()
                    ->wrap(),

                TextColumn::make('bobot')
                    ->label('Bobot')
                    ->suffix('%')
                    ->sortable(),
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
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
