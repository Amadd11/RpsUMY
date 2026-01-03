<?php

namespace App\Filament\Resources\Dosens;

use BackedEnum;
use App\Models\Dosen;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Dosens\Pages\EditDosen;
use App\Filament\Resources\Dosens\Pages\ListDosens;
use App\Filament\Resources\Dosens\Pages\CreateDosen;
use App\Filament\Resources\Dosens\Schemas\DosenForm;
use App\Filament\Resources\Dosens\Tables\DosensTable;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Dosen';

    protected static ?string $pluralLabel     = 'Dosen';

    public static function form(Schema $schema): Schema
    {
        return DosenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DosensTable::configure($table);
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
            'index' => ListDosens::route('/'),
            'create' => CreateDosen::route('/create'),
            'edit' => EditDosen::route('/{record}/edit'),
        ];
    }
}
