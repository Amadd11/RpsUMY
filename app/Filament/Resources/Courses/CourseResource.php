<?php

namespace App\Filament\Resources\Courses;

use BackedEnum;
use App\Models\Course;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Courses\Pages\EditCourse;
use App\Filament\Resources\Courses\Pages\ListCourses;
use App\Filament\Resources\Courses\Pages\CreateCourse;
use App\Filament\Resources\Courses\Schemas\CourseForm;
use App\Filament\Resources\Courses\Tables\CoursesTable;
use UnitEnum;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;

    protected static ?string $navigationLabel = 'Mata Kuliah';
    protected static ?string $pluralLabel = 'Mata Kuliah';
    protected static string|UnitEnum|null $navigationGroup = 'Akademik';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CourseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoursesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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



    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }
}
