@props([
    'blocks' => [],
    'statePath' => null,
    'schemaComponent' => null,
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
@endphp

<x-filament-tiptap-editor::dropdown-button
    label="{{ trans('filament-tiptap-editor::editor.blocks.insert') }}"
    icon="blocks"
    :active="true"
>
    @foreach($blocks as $key => $block)
        <x-filament-tiptap-editor::dropdown-button-item
            action="$wire.mountAction('insertBlock', {
                type: '{{ $key }}'
            }, { schemaComponent: '{{ $schemaComponentKey }}' })"
        >
            {{ $block->getLabel() }}
        </x-filament-tiptap-editor::dropdown-button-item>
    @endforeach
</x-filament-tiptap-editor::dropdown-button>