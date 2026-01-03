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
                    ->required(),

                Select::make('cpl_id')
                    ->label('CPL Terkait')
                    ->options(
                        fn(RelationManager $livewire) =>
                        $livewire->ownerRecord
                            ? $livewire->ownerRecord
                            ->cpls()
                            ->pluck('cpls.code', 'cpls.id')
                            ->toArray()
                            : []
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => [
                        $set('cpmk_id', null),
                        $set('sub_cpmk_id', null),
                    ])
                    ->required(),

                Select::make('cpmk_id')
                    ->label('CPMK Terkait')
                    ->options(function (Get $get, RelationManager $livewire): Collection {
                        $cplId = $get('cpl_id');
                        $rpsId = $livewire->ownerRecord?->id;

                        if (! $cplId || ! $rpsId) {
                            return collect();
                        }

                        return Cpmk::where('cpl_id', $cplId)
                            ->where('rps_id', $rpsId)
                            ->pluck('code', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('sub_cpmk_id', null))
                    ->required(),

                Select::make('subcpmk_id')
                    ->label('Sub-CPMK')
                    ->options(function (Get $get): Collection {
                        $cpmkId = $get('cpmk_id');

                        if (! $cpmkId) {
                            return collect();
                        }

                        return Subcpmk::where('cpmk_id', $cpmkId)
                            ->pluck('code', 'id');
                    })
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
