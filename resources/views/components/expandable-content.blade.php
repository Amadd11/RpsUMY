<div x-data="{ expanded: false, isOverflowing: false }" x-init="$nextTick(() => { isOverflowing = $refs.content.scrollHeight > {{ $threshold ?? 120 }} })" class="space-y-1">
    <div x-ref="content"
        class="prose prose-sm max-w-none overflow-hidden transition-all duration-300 text-foreground leading-relaxed line-clamp-4"
        :class="expanded ? 'max-h-full' : 'max-h-32'"
        :style="expanded ? '' : 'display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;'">
        {!! $content !!}
    </div>
    <template x-if="isOverflowing">
        <button @click="expanded = !expanded"
            class="flex items-center gap-1 -ml-1 text-[10px] font-bold uppercase tracking-wider {{ $buttonColor }}-600 hover:{{ $buttonColor }}-800 transition-colors">
            <span x-text="expanded ? 'Baca Lebih Sedikit' : 'Baca Selengkapnya'"></span>
            <iconify-icon :icon="expanded ? 'solar:alt-arrow-up-linear' : 'solar:alt-arrow-down-linear'"
                class="size-3"></iconify-icon>
        </button>
    </template>
</div>
