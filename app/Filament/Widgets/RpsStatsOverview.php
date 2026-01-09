<?php

namespace App\Filament\Widgets;

use App\Models\Rps;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class RpsStatsOverview extends StatsOverviewWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        $user = Auth::user();

        $courseQuery = Course::query();
        $rpsQuery = Rps::query();

        // 🔐 Role-based filter
        if ($user->hasRole('Admin Prodi')) {
            $courseQuery->where('prodi_id', $user->prodi_id);
            $rpsQuery->whereHas(
                'course',
                fn($q) =>
                $q->where('prodi_id', $user->prodi_id)
            );
        }

        if ($user->hasRole('Admin Fakultas')) {
            $courseQuery->whereHas(
                'prodi',
                fn($q) =>
                $q->where('fakultas_id', $user->fakultas_id)
            );
            $rpsQuery->whereHas(
                'course.prodi',
                fn($q) =>
                $q->where('fakultas_id', $user->fakultas_id)
            );
        }

        // 📚 Course stats
        $totalCourses = $courseQuery->count();
        $coursesWithRps = (clone $rpsQuery)->count();
        $coursesWithoutRps = max($totalCourses - $coursesWithRps, 0);

        // 📄 RPS stats
        $rpsLengkap = (clone $rpsQuery)
            ->has('cpls')
            ->has('cpmks')
            ->has('subCpmks')
            ->has('evaluasis')
            ->has('referensi')
            ->has('tugas')
            ->has('rencanas')
            ->count();

        return [
            Stat::make('Total Mata Kuliah', $totalCourses)
                ->description('Jumlah seluruh mata kuliah yang terdaftar')
                ->icon('heroicon-o-book-open'),

            Stat::make('Sudah Ada RPS', $coursesWithRps)
                ->description('Mata kuliah yang sudah memiliki dokumen RPS')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Belum Ada RPS', $coursesWithoutRps)
                ->description('Mata kuliah yang belum dibuatkan RPS')
                ->icon('heroicon-o-exclamation-circle')
                ->color('danger'),

            Stat::make('RPS Lengkap', $rpsLengkap)
                ->description('Mata Kuliah yang RPS-nya sudah lengkap')
                ->icon('heroicon-o-check-badge')
                ->color('success'),

            Stat::make('RPS Belum Lengkap', max($coursesWithRps - $rpsLengkap, 0))
                ->description('Mata Kuliah yang RPS-nya belum lengkap')
                ->icon('heroicon-o-clock')
                ->color('warning'),
        ];
    }
}
