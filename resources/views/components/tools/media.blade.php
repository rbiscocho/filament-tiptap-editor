@props([
    'statePath' => null,
    'schemaComponent' => null,
    'icon' => 'media',
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
@endphp

<x-filament-tiptap-editor::button
    action="$wire.mountAction('filament_tiptap_media', {}, { schemaComponent: '{{ $schemaComponentKey }}' })"
    label="{{ trans('filament-tiptap-editor::editor.media.insert_edit') }}"
    active="image"
    :icon="$icon"
/>