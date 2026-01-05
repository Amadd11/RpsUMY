<?php

namespace App\Filament\Resources\Cpls;

use BackedEnum;
use App\Models\Cpl;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Cpls\Pages\EditCpl;
use App\Filament\Resources\Cpls\Pages\ListCpls;
use App\Filament\Resources\Cpls\Pages\CreateCpl;
use App\Filament\Resources\Cpls\Schemas\CplForm;
use App\Filament\Resources\Cpls\Tables\CplsTable;
use UnitEnum;

class CplResource extends Resource
{
    protected static ?string $model = Cpl::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $navigationLabel = 'Capaian Lulusan (CPL)';
    protected static ?string $pluralModelLabel = 'CPL';
    protected static string|UnitEnum|null $navigationGroup = 'Akademik';

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return CplForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CplsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        $query = parent::getEloquentQuery();

        if (!$user) {
            return $query;
        }

        // Admin Prodi hanya lihat matkul milik prodi-nya
        if ($user->hasRole('Admin Prodi') && $user->prodi_id) {
            return $query->where('prodi_id', $user->prodi_id);
        }

        // Admin Fakultas hanya lihat matkul dari prodi dalam fakultas itu
        if ($user->hasRole('Admin Fakultas') && $user->fakultas_id) {
            return $query->whereHas('prodi', function ($q) use ($user) {
                $q->where('fakultas_id', $user->fakultas_id);
            });
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCpls::route('/'),
            'create' => CreateCpl::route('/create'),
            'edit' => EditCpl::route('/{record}/edit'),
        ];
    }
}
