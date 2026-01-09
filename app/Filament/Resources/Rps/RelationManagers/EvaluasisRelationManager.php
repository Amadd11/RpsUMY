<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use App\Models\Cpmk;
use App\Models\Subcpmk;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Collection;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\DissociateBulkAction;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\RelationManagers\RelationManager;

class EvaluasisRelationManager extends RelationManager
{
    protected static string $relationship = 'evaluasis';

    protected static ?string $title = 'Evaluasi';
    protected static ?string $modelLabel = 'Evaluasi';
    protected static ?string $pluralModelLabel = 'Evaluasi';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('week')
                    ->label('Minggu Ke-')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Select::make('cpl_id')
                    ->label('CPL Terkait')
                    ->options(
                        fn(RelationManager $livewire) =>
                        $livewire->ownerRecord
                            ? $livewire->ownerRecord->cpls()->pluck('cpls.code', 'cpls.id')
                            : collect()
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => [
                        $set('cpmk_id', null),
                        $set('subcpmk_id', null),
                    ])
                    ->required(),

                Select::make('cpmk_id')
                    ->label('CPMK Terkait')
                    ->options(function (Get $get, RelationManager $livewire) {
                        return Cpmk::query()
                            ->when(
                                $get('cpl_id') && $livewire->ownerRecord,
                                fn($q) => $q
                                    ->where('cpl_id', $get('cpl_id'))
                                    ->where('rps_id', $livewire->ownerRecord->id)
                            )
                            ->pluck('code', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('subcpmk_id', null))
                    ->required(),

                Select::make('subcpmk_id')
                    ->label('Sub-CPMK')
                    ->options(
                        fn(Get $get) =>
                        Subcpmk::where('cpmk_id', $get('cpmk_id'))
                            ->pluck('code', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                RichEditor::make('indikator')
                    ->label('Indikator Penilaian')
                    ->columnSpanFull(),

                RichEditor::make('bentuk_penilaian')
                    ->label('Bentuk Penilaian')
                    ->columnSpanFull(),

                TextInput::make('bobot_sub_cpmk')
                    ->label('Bobot Sub-CPMK (%)')
                    ->numeric()
                    ->suffix('%'),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                TextColumn::make('week'),
                TextColumn::make('subCpmk.code')->label('Sub-CPMK')->limit(50),
                TextColumn::make('bobot_sub_cpmk')->label('Bobot Sub-CPMK'),
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
