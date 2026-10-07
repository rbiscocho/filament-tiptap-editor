@props([
    'statePath' => null,
    'schemaComponent' => null,
    'icon' => 'media',
])

@php
    $schemaComponentKey = $schemaComponent ?? ('form.' . $statePath);
    $action = "\$wire.mountAction('filament_tiptap_edit_media', arguments, { schemaComponent: " . \Illuminate\Support\Js::from($schemaComponentKey) . " });";
@endphp

<x-filament-tiptap-editor::button
    action="openModal()"
    label="{{ trans('filament-tiptap-editor::editor.media.edit') }}"
    active="image"
    :icon="$icon"
    x-data="{
        openModal() {
            let media = this.editor().getAttributes('image');
            let arguments = {
                type: 'media',
                src: media.src || '',
                alt: media.alt || '',
                title: media.title || '',
                width: media.width || '',
                height: media.height || '',
                lazy: media.lazy || false,
                media: media.media || '',
                srcset: media.srcset || '',
                sizes: media.sizes || '',
            };

            {{ $action }}
        }
    }"
/>