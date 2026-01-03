 <div class="bg-card rounded-3xl p-8 shadow-xl border border-border">
     <h2 class="text-2xl font-bold mb-6 text-foreground">Matriks Evaluasi & Penilaian</h2>
     <div class="overflow-x-auto rounded-2xl border border-border">
         <table class="w-full text-sm text-left">
             <thead class="bg-primary text-primary-foreground">
                 <tr>
                     <th class="p-4 text-center">CPMK</th>
                     <th class="p-4">Sub-CPMK</th>
                     <th class="p-4">Indikator Penilaian</th>
                     <th class="p-4 text-center">Bobot</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($groupedEvaluasi as $cpmkId => $items)
                     @foreach ($items as $index => $item)
                         <tr class="border-b border-border">
                             @if ($index === 0)
                                 <td rowspan="{{ count($items) }}"
                                     class="p-4 font-black bg-secondary/50 border-r align-top text-primary max-w-[150px]">
                                     {{ $item->cpmk->title ?? 'CPMK' }}
                                 </td>
                             @endif
                             <td class="p-4 font-bold border-r text-muted-foreground italic bg-card">
                                 {{ $item->subCpmk->code ?? '-' }}</td>
                             <td class="p-4 border-r max-w-md text-foreground">{!! $item->indikator !!}</td>
                             <td class="p-4 text-center font-bold text-secondary-foreground bg-secondary/20">
                                 {{ $item->bobot }}%</td>
                         </tr>
                     @endforeach
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
