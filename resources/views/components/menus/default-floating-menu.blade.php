@props([
    'statePath' => null,
    'schemaComponent' => null,
    'tools' => [],
    'blocks' => [],
    'shouldSupportBlocks' => false,
    'editor' => null,
])

<div
    class="flex gap-1 items-center"
    x-show="editor().isActive('paragraph', updatedAt)"
    style="display: none;"
>
    @forelse ($tools as $tool)
        @if (is_array($tool))
            <x-dynamic-component component="{{ $tool['button'] }}" :state-path="$statePath" :schema-component="$schemaComponent" :editor="$editor" />
        @elseif ($tool === 'blocks')
            @if ($blocks && $shouldSupportBlocks)
                <x-filament-tiptap-editor::tools.blocks :blocks="$blocks" :state-path="$statePath" :schema-component="$schemaComponent" :editor="$editor" />
            @endif
        @else
            <x-dynamic-component component="filament-tiptap-editor::tools.{{ $tool }}" :state-path="$statePath" :schema-component="$schemaComponent" :editor="$editor" />
        @endif
    @empty
        <p>No tools defined for menu.</p>
    @endforelse
</div>
