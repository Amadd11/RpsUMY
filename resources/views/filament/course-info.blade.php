<div class="p-3 rounded-lg bg-gray-50 text-sm">
    @if ($course)
        <div><strong>Nama Mata Kuliah:</strong> {{ $course->name }}</div>
        <div><strong>Kode:</strong> {{ $course->kode_mk }}</div>
        <div><strong>SKS:</strong> {{ $course->sks }}</div>
        <div><strong>Semester:</strong> {{ $course->semester }}</div>
    @else
        <div class="text-gray-500">Pilih mata kuliah dulu untuk melihat detail.</div>
    @endif
</div>
