<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CplsRelationManager extends RelationManager
{
    protected static string $relationship = 'cpls';

    protected static ?string $title = 'CPL';
    protected static ?string $modelLabel = 'CPL';
    protected static ?string $pluralModelLabel = 'CPL';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode CPL')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('taksonomi')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('bobot')
                    ->label('Bobot CPL (%)')
                    ->numeric()
                    ->required()
                    ->helperText('Masukkan bobot CPL untuk mata kuliah ini')
                    ->suffix('%'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                TextColumn::make('code')
                    ->label('Kode CPL')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->html()
                    ->label('Deskripsi')
                    ->wrap(),

                TextColumn::make('taksonomi')
                    ->label('Taksonomi')
                    ->badge(),

                TextColumn::make('pivot.bobot')
                    ->label('Bobot (%)')
                    ->sortable()
                    ->alignCenter()
                    ->color('success'),
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
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
