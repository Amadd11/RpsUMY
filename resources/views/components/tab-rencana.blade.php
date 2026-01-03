<div class="bg-card rounded-3xl p-8 shadow-xl border border-border">
    <h2 class="text-2xl font-bold mb-6 text-foreground">Rencana Pembelajaran Mingguan</h2>
    <div class="overflow-x-auto rounded-2xl border border-border">
        <table class="w-full text-sm text-left">
            <thead class="bg-primary text-primary-foreground">
                <tr>
                    <th class="p-4 text-center">Mgg</th>
                    <th class="p-4">Materi Pembelajaran</th>
                    <th class="p-4">Metode (Luring/Daring)</th>
                    <th class="p-4 text-center">Bobot</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @foreach ($rps->rencanas->sortBy('week') as $rencana)
                    <tr class="hover:bg-muted/50">
                        <td class="p-4 text-center font-bold text-primary bg-secondary/30">
                            {{ $rencana->week }}</td>
                        <td class="p-4 font-medium text-foreground">{!! $rencana->materi_pembelajaran !!}</td>
                        <td class="p-4 text-muted-foreground italic">
                            <div class="mb-1 text-xs font-bold text-muted-foreground/80 uppercase">Luring:
                            </div>
                            {{ $rencana->luring ?? '-' }}
                            <div class="mt-2 mb-1 text-xs font-bold text-muted-foreground/80 uppercase border-t pt-1">
                                Daring:</div> {{ $rencana->daring ?? '-' }}
                        </td>
                        <td class="p-4 text-center font-black text-secondary-foreground">
                            {{ $rencana->bobot }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
