<?php

namespace App\Filament\Resources\Dokumens;

use BackedEnum;
use App\Models\Dokumen;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Dokumens\Pages\EditDokumen;
use App\Filament\Resources\Dokumens\Pages\ListDokumens;
use App\Filament\Resources\Dokumens\Pages\CreateDokumen;
use App\Filament\Resources\Dokumens\Schemas\DokumenForm;
use App\Filament\Resources\Dokumens\Tables\DokumensTable;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static ?string $navigationLabel = 'Dokumen';
    protected static ?string $pluralModelLabel = 'Dokumen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return DokumenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DokumensTable::configure($table);
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
            'index' => ListDokumens::route('/'),
            'create' => CreateDokumen::route('/create'),
            'edit' => EditDokumen::route('/{record}/edit'),
        ];
    }
}
