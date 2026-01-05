@props(['content' => null])

<div class="prose prose-sm max-w-none leading-relaxed text-foreground">
    {!! blank($content) ? '<span class="text-muted-foreground">-</span>' : $content !!}
</div>
