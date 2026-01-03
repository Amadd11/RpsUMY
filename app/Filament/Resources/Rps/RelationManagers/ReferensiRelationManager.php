<?php

namespace App\Filament\Resources\Rps\RelationManagers;

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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\DissociateBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class ReferensiRelationManager extends RelationManager
{
    protected static string $relationship = 'referensi';

    protected static ?string $title = 'Referensi';
    protected static ?string $modelLabel = 'Referensi';
    protected static ?string $pluralModelLabel = 'Referensi';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tipe')
                    ->label('Tipe Referensi')
                    ->options([
                        'utama' => 'Utama',
                        'tambahan' => 'Tambahan',
                    ])
                    ->required()
                    ->default('utama'),

                RichEditor::make('referensi')
                    ->label('Referensi')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tipe')
            ->columns([
                TextColumn::make('tipe')
                    ->label('Tipe')
                    ->badge()
                    ->colors([
                        'primary' => 'utama',
                        'success' => 'pendukung',
                    ]),

                TextColumn::make('referensi')
                    ->label('Referensi')
                    ->limit(250)
                    ->html()
                    ->wrap(),
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
