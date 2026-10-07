<?php

declare(strict_types=1);

namespace FilamentTiptapEditor\Concerns;

use Closure;
use Filament\Actions\Action;
use FilamentTiptapEditor\Actions\EditMediaAction;
use FilamentTiptapEditor\Actions\GridBuilderAction;
use FilamentTiptapEditor\Actions\LinkAction;
use FilamentTiptapEditor\Actions\MediaAction;
use FilamentTiptapEditor\Actions\OEmbedAction;

trait HasCustomActions
{
    public string|Closure|null $linkAction = null;

    public string|Closure|null $mediaAction = null;

    public string|Closure|null $editMediaAction = null;

    public string|Closure|null $gridBuilderAction = null;

    public string|Closure|null $oembedAction = null;

    public function linkAction(string|Closure $action): static
    {
        $this->linkAction = $action;

        return $this;
    }

    public function mediaAction(string|Closure $action): static
    {
        $this->mediaAction = $action;

        return $this;
    }

    public function oembedAction(string|Closure $action): static
    {
        $this->oembedAction = $action;

        return $this;
    }

    public function getLinkAction(): Action
    {
        $action = $this->resolveActionClass(
            configured: $this->linkAction,
            configKey: 'filament-tiptap-editor.link_action',
            fallback: LinkAction::class,
        );

        return $action::make();
    }

    public function getMediaAction(): Action
    {
        $action = $this->resolveActionClass(
            configured: $this->mediaAction,
            configKey: 'filament-tiptap-editor.media_action',
            fallback: MediaAction::class,
        );

        return $action::make();
    }

    public function editMediaAction(string|Closure $action): static
    {
        $this->editMediaAction = $action;

        return $this;
    }

    public function getEditMediaAction(): Action
    {
        $action = $this->resolveActionClass(
            configured: $this->editMediaAction,
            configKey: 'filament-tiptap-editor.edit_media_action',
            fallback: EditMediaAction::class,
        );

        return $action::make();
    }

    public function gridBuilderAction(string|Closure $action): static
    {
        $this->gridBuilderAction = $action;

        return $this;
    }

    public function getGridBuilderAction(): Action
    {
        $action = $this->resolveActionClass(
            configured: $this->gridBuilderAction,
            configKey: 'filament-tiptap-editor.grid_builder_action',
            fallback: GridBuilderAction::class,
        );

        return $action::make();
    }

    public function getOEmbedAction(): Action
    {
        $action = $this->resolveActionClass(
            configured: $this->oembedAction,
            configKey: 'filament-tiptap-editor.oembed_action',
            fallback: OEmbedAction::class,
        );

        return $action::make();
    }

    protected function resolveActionClass(string|Closure|null $configured, string $configKey, string $fallback): string
    {
        $action = $this->evaluate($configured) ?? config($configKey);

        if (is_string($action) && class_exists($action)) {
            return $action;
        }

        return $fallback;
    }
}
