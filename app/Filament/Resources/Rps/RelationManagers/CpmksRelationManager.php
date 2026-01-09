<?php

namespace App\Filament\Resources\Rps\RelationManagers;

use App\Models\Cpl;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\DissociateBulkAction;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\RelationManagers\RelationManager;

class CpmksRelationManager extends RelationManager
{
    protected static string $relationship = 'cpmks';

    protected static ?string $title = 'CPMK';
    protected static ?string $modelLabel = 'CPMK';
    protected static ?string $pluralModelLabel = 'CPMK';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Judul CPMK')
                    ->required()
                    ->columnSpanFull(),

                Select::make('cpl_id')
                    ->label('Terkait CPL (Induk)')
                    ->options(function ($livewire) {
                        $user = Auth::user();

                        $query = $livewire->ownerRecord?->cpls();
                        if (! $query) {
                            return [];
                        }

                        if ($user->hasRole('Admin Prodi')) {
                            $query->where('prodi_id', $user->prodi_id);
                        }

                        if ($user->hasRole('Admin Fakultas')) {
                            $query->whereHas(
                                'prodi',
                                fn($q) =>
                                $q->where('fakultas_id', $user->fakultas_id)
                            );
                        }

                        return $query
                            ->select('cpls.id', 'cpls.code')
                            ->pluck('cpls.code', 'cpls.id');
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(
                        fn($state, Set $set) =>
                        $set(
                            'cpl_description_preview',
                            $state
                                ? strip_tags(
                                    Cpl::whereKey($state)->value('description')
                                )
                                : '-'
                        )
                    )
                    ->helperText('Hanya CPL yang sudah dipilih pada RPS ini yang akan tampil.'),

                Textarea::make('cpl_description_preview')
                    ->label('Deskripsi CPL')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(
                        fn($state, $record) =>
                        strip_tags($state ?: ($record?->cpl?->description ?? ''))
                    )
                    ->rows(3)
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Deskripsi')
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
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('cpl.code')
                    ->label('Dari CPL')
                    ->badge()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->html()
                    ->wrap()
                    ->limit(50)
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
