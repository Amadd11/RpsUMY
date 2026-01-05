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
        /** -------------------------------------------
         *  Tahun Ajaran Options
         * -------------------------------------------- */
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
                ->unique(Rps::class, 'course_id') // Cegah duplikasi via validation (otomatis ignore current record saat edit)
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
            // Action::make('lihat_matriks')
            //     ->label('Lihat Matriks Kurikulum')
            //     ->icon('heroicon-o-document-text')
            //     ->modalWidth('7xl')
            //     ->modalSubmitAction(false) // Biasanya hanya view, jadi tidak butuh tombol save
            //     ->modalContent(function ($record) {
            //         // Memanggil service secara otomatis
            //         $service = app(\App\Services\DokumenService::class);

            //         // Ambil data menggunakan logika yang sama dengan controller
            //         $dokumen = $service->getSingleMatriksByProdiId($record->course->prodi_id);

            //         return view('dokumen.index', [
            //             'dokumen' => $dokumen, // Variabel tunggal untuk modal
            //             'prodi'   => $record->course->prodi
            //         ]);
            //     }),
            Section::make('Capaian Pembelajaran Lulusan (CPL)')
                ->description('Pilih CPL yang dibebankan pada mata kuliah ini.')
                ->schema([
                    CheckboxList::make('cpls')
                        ->label('CPL')
                        ->relationship(
                            name: 'cpls',
                            titleAttribute: 'code',
                            modifyQueryUsing: function (Builder $query) {
                                $user = Auth::user();

                                // Admin Prodi → CPL prodinya
                                if ($user->hasRole('Admin Prodi') && $user->prodi_id) {
                                    $query->where('prodi_id', $user->prodi_id);
                                }

                                // Admin Fakultas → CPL prodi dalam fakultasnya
                                if ($user->hasRole('Admin Fakultas') && $user->fakultas_id) {
                                    $query->whereHas('prodi', function ($q) use ($user) {
                                        $q->where('fakultas_id', $user->fakultas_id);
                                    });
                                }

                                return $query;
                            }
                        )
                        ->columns(2)
                        ->helperText('Pilih satu atau lebih CPL yang sesuai.')
                        ->required(),
                ])
        ]);
    }
}
