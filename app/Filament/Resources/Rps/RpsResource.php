<?php

namespace App\Filament\Resources\Rps;

use UnitEnum;
use BackedEnum;
use App\Models\Rps;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Rps\Pages\EditRps;
use App\Filament\Resources\Rps\Pages\ListRps;
use App\Filament\Resources\Rps\Pages\CreateRps;
use App\Filament\Resources\Rps\Schemas\RpsForm;
use App\Filament\Resources\Rps\Tables\RpsTable;
use App\Filament\Resources\Rps\RelationManagers\CplsRelationManager;
use App\Filament\Resources\Rps\RelationManagers\CpmksRelationManager;
use App\Filament\Resources\Rps\RelationManagers\EvaluasisRelationManager;
use App\Filament\Resources\Rps\RelationManagers\ReferensiRelationManager;
use App\Filament\Resources\Rps\RelationManagers\RencanaRelationManager;
use App\Filament\Resources\Rps\RelationManagers\SubcpmksRelationManager;

class RpsResource extends Resource
{
    protected static ?string $model = Rps::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'RPS';
    protected static ?string $pluralLabel = 'RPS';
    protected static string|UnitEnum|null $navigationGroup = 'Akademik';


    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return RpsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RpsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        $query = parent::getEloquentQuery();

        if (! $user) {
            return $query;
        }

        if ($user->hasRole('Admin Prodi') && $user->prodi_id) {
            return $query->whereHas('course', function ($q) use ($user) {
                $q->where('prodi_id', $user->prodi_id);
            });
        }

        if ($user->hasRole('Admin Fakultas') && $user->fakultas_id) {
            return $query->whereHas('course.prodi', function ($q) use ($user) {
                $q->where('fakultas_id', $user->fakultas_id);
            });
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
            CplsRelationManager::class,
            CpmksRelationManager::class,
            SubcpmksRelationManager::class,
            RencanaRelationManager::class,
            EvaluasisRelationManager::class,
            ReferensiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRps::route('/'),
            'create' => CreateRps::route('/create'),
            'edit' => EditRps::route('/{record}/edit'),
        ];
    }
}
