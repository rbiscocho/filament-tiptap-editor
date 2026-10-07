<?php

declare(strict_types=1);

namespace FilamentTiptapEditor\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use FilamentTiptapEditor\TiptapEditor;

class SourceAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'filament_tiptap_source';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->modalHeading(trans('filament-tiptap-editor::source-modal.heading'))
            ->fillForm(function (TiptapEditor $component, array $arguments): array {
                $source = $arguments['html'] ?? null;

                if ($source === null) {
                    $state = $component->getState();

                    $source = is_string($state)
                        ? $state
                        : tiptap_converter()->asHTML($state);
                }

                return ['source' => $source];
            })
            ->schema([
                Textarea::make('source')
                    ->label(trans('filament-tiptap-editor::source-modal.labels.source'))
                    ->extraAttributes(['class' => 'source_code_editor']),
            ])
            ->modalWidth('screen')
            ->action(function (TiptapEditor $component, $data) {

                $content = $data['source'] ?? '<p></p>';

                $content = tiptap_converter()->asJSON($content, decoded: true);

                if ($component->shouldSupportBlocks()) {
                    $content = $component->renderBlockPreviews($content, $component);
                }

                $component->getLivewire()->dispatch(
                    event: 'insertFromAction',
                    type: 'source',
                    statePath: $component->getStatePath(),
                    source: $content,
                );

                $component->state($content);
            });
    }
}
