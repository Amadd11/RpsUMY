<?php

namespace App\Filament\Resources\Rps\Schemas;

use App\Models\Rps;
use App\Models\Course;
use App\Models\Dokumen;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\View;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Utilities\Set; // Ubah import Set ke Schemas namespace

class RpsForm
{
    public static function configure(Schema $schema): Schema
    {
        $years = range(2021, 2028);
        $academicYears = [];
        foreach ($years as $year) {
            $academicYears["{$year}/" . ($year + 1)] = "{$year}/" . ($year + 1);
        }

        return $schema->components([
            Select::make('course_id')
                ->label('Pilih Mata Kuliah')
                ->relationship(
                    name: 'course',
                    titleAttribute: 'name',
                    modifyQueryUsing: function (Builder $query) {
                        $user = Auth::user();

                        // Admin Prodi → hanya matkul di prodi sendiri
                        if ($user->hasRole('Admin Prodi')) {
                            $query->where('prodi_id', $user->prodi_id);
                        }

                        // Admin Fakultas → matkul dalam fakultasnya
                        if ($user->hasRole('Admin Fakultas')) {
                            $query->whereHas('prodi', function ($q) use ($user) {
                                $q->where('fakultas_id', $user->fakultas_id);
                            });
                        }

                        return $query;
                    }
                )
                ->searchable()
                ->preload()
                ->required()
                ->unique(Rps::class, 'course_id')
                ->live()
                ->afterStateHydrated(function (Set $set, $state) {
                    if ($course = Course::find($state)) {
                        $set('semester', $course->semester);
                    }
                })
                ->afterStateUpdated(function (Set $set, $state) {
                    if ($course = Course::find($state)) {
                        $set('semester', $course->semester);
                    } else {
                        $set('semester', null);
                    }
                })
                ->columnSpanFull(),

            Select::make('dosen_id')
                ->label('Penanggung Jawab')
                ->relationship(
                    name: 'dosen',
                    titleAttribute: 'name',
                    modifyQueryUsing: function (Builder $query) {
                        $user = Auth::user();

                        // Admin Prodi
                        if ($user->hasRole('Admin Prodi')) {
                            $query->where('prodi_id', $user->prodi_id);
                        }

                        // Admin Fakultas
                        if ($user->hasRole('Admin Fakultas')) {
                            $query->whereHas('prodi', function ($q) use ($user) {
                                $q->where('fakultas_id', $user->fakultas_id);
                            });
                        }

                        return $query;
                    }
                )
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('semester')
                ->label('Semester')
                ->disabled()
                ->readOnly()
                ->columnSpanFull(),
            Select::make('tahun_ajaran')
                ->label('Tahun Ajaran')
                ->options($academicYears) // Gunakan array yang sudah kita buat
                ->default(now()->format('Y') . '/' . (now()->addYear()->format('Y'))) // Default tetap tahun sekarang
                ->searchable()
                ->required()
                ->extraInputAttributes(['class' => 'min-h-[40px]']),

            DatePicker::make('tgl_penyusunan')
                ->label('Tanggal Penyusunan')
                ->default(now())
                ->required()
                ->extraInputAttributes(['class' => 'min-h-[40px]']),
            RichEditor::make('deskripsi')
                ->label('Deskripsi RPS')
                ->columnSpanFull(),
            RichEditor::make('materi_pembelajaran')
                ->label('Mater Pembelajaran/Bahan Kajian')
                ->columnSpanFull(),
            FileUpload::make('file_pdf')
                ->label('PDF RPS')
                ->directory('rps')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf'])
                ->preserveFilenames()
                ->openable()
                ->downloadable()
                ->columnSpanFull(),
            Section::make('Capaian Pembelajaran Lulusan (CPL)')
                ->description('Sebelum memilih CPL, Harap melihat Dokumen OBE pada program studi terkait untuk memastikan kesesuaian CPL dengan RPS yang dibuat.')
                ->schema([
                    CheckboxList::make('cpls')
                        ->label('CPL')
                        ->relationship(
                            name: 'cpls',
                            titleAttribute: 'code',
                            modifyQueryUsing: function (Builder $query, callable $get) {

                                $courseId = $get('course_id');

                                // 🚫 Belum pilih mata kuliah → jangan tampilkan CPL
                                if (! $courseId) {
                                    $query->whereRaw('1 = 0');
                                    return $query;
                                }

                                $course = Course::find($courseId);

                                if ($course?->prodi_id) {
                                    $query->where('prodi_id', $course->prodi_id);
                                }
                            }
                        )
                        ->helperText(
                            fn($record) =>
                            $record?->course?->prodi
                                ? 'Menampilkan CPL Program Studi: ' . $record->course->prodi->name
                                : 'Pilih mata kuliah terlebih dahulu'
                        )
                        ->required()
                        ->columnSpanFull(),
                ])
        ]);
    }
}
