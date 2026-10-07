@props([
    'statePath' => null,
    'schemaComponent' => null,
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
@endphp

<x-filament-tiptap-editor::button
    action="$wire.mountAction('filament_tiptap_source', {}, { schemaComponent: '{{ $schemaComponentKey }}' })"
    label="{{ trans('filament-tiptap-editor::editor.source') }}"
    icon="source"
/>
