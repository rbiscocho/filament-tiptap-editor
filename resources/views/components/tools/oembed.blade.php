@props([
    'statePath' => null,
    'schemaComponent' => null,
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
@endphp

<x-filament-tiptap-editor::button
    action="$wire.mountAction('filament_tiptap_oembed', {}, { schemaComponent: '{{ $schemaComponentKey }}' })"
    active="oembed"
    label="{{ trans('filament-tiptap-editor::editor.video.oembed') }}"
    icon="oembed"
/>