<?php

declare(strict_types=1);

namespace FilamentTiptapEditor\Concerns;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\Facades\TiptapConverter;

trait CanStoreOutput
{
    protected ?TiptapOutput $output = null;

    public function output(TiptapOutput $output): static
    {
        $this->output = $output;

        return $this;
    }

    public function getOutput(): TiptapOutput
    {
        if ($this->output instanceof TiptapOutput) {
            return $this->output;
        }

        $configuredOutput = config('filament-tiptap-editor.output');

        if ($configuredOutput instanceof TiptapOutput) {
            return $configuredOutput;
        }

        if (is_string($configuredOutput)) {
            return TiptapOutput::tryFrom(strtolower($configuredOutput)) ?? TiptapOutput::Html;
        }

        return TiptapOutput::Html;
    }

    public function getHTML(): string
    {
        return TiptapConverter::asHTML($this->getState());
    }

    public function getText(): string
    {
        return TiptapConverter::asText($this->getState());
    }

    public function getJSON(bool $decoded = false): string|array
    {
        return TiptapConverter::asJSON($this->getState(), decoded: $decoded);
    }

    public function expectsHTML(): bool
    {
        return $this->getOutput() === TiptapOutput::Html;
    }

    public function expectsJSON(): bool
    {
        return $this->getOutput() === TiptapOutput::Json;
    }

    public function expectsText(): bool
    {
        return $this->getOutput() === TiptapOutput::Text;
    }
}
