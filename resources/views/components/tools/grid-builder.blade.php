@props([
    'statePath' => null,
    'schemaComponent' => null,
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
@endphp

<x-filament-tiptap-editor::button
    action="$wire.mountAction('filament_tiptap_grid', {}, { schemaComponent: '{{ $schemaComponentKey }}' })"
    active="grid-builder"
    label="{{ trans('filament-tiptap-editor::editor.grid-builder.label') }}"
    icon="grid-builder"
/>
