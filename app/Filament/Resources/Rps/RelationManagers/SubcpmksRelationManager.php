<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use App\Models\Cpmk;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Utilities\Set;

class SubcpmksRelationManager extends RelationManager
{
    protected static string $relationship = 'subcpmks';

    protected static ?string $title = 'Sub-CPMK';
    protected static ?string $modelLabel = 'Sub-CPMK';
    protected static ?string $pluralModelLabel = 'Sub-CPMK';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('code')
                ->label('Kode Sub CPMK')
                ->required()
                ->maxLength(255),

            Select::make('cpmk_id')
                ->label('CPMK Induk')
                ->required()
                ->options(
                    fn() =>
                    $this->ownerRecord
                        ->cpmks()
                        ->pluck('code', 'id')
                )
                ->searchable()
                ->preload()
                ->live()
                ->afterStateUpdated(function ($state, Set $set) {
                    $cpmk = Cpmk::find($state);
                    $set(
                        'cpmk_description_preview',
                        $cpmk ? strip_tags($cpmk->description) : '-'
                    );
                }),

            Textarea::make('cpmk_description_preview')
                ->label('Deskripsi CPMK')
                ->disabled()
                ->dehydrated(false)
                ->rows(3)
                ->columnSpanFull(),

            RichEditor::make('description')
                ->label('Deskripsi Sub CPMK')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),

                TextColumn::make('cpmk.code')
                    ->label('CPMK Induk')
                    ->badge(),
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
