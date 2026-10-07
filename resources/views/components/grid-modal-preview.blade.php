@php
    $mountedActions = $getLivewire()->mountedActions ?? [];
    $mountedAction = filled($mountedActions) ? ($mountedActions[array_key_last($mountedActions)] ?? []) : [];
    $data = $mountedAction['data'] ?? [];

    $columns = (int) ($data['columns'] ?? 2);
    $asymmetric = (bool) ($data['asymmetric'] ?? false);
    $asymmetricLeft = max(1, (int) ($data['asymmetric_left'] ?? 1));
    $asymmetricRight = max(1, (int) ($data['asymmetric_right'] ?? 1));
@endphp

<div class="rounded-lg p-4 bg-gray-100 dark:bg-gray-950">
    <div class="grid gap-4" style="grid-template-columns: repeat({{ max($columns, 1) }}, minmax(0, 1fr))">
        @if ($asymmetric)
            <div
                class="bg-gray-300 dark:bg-gray-800 rounded-lg border border-dashed border-white dark:border-gray-600 p-0.5 text-center"
                style="grid-column: span {{ $asymmetricLeft }};"
            >
                <p>1</p>
            </div>
            <div
                class="bg-gray-300 dark:bg-gray-800 rounded-lg border border-dashed border-white dark:border-gray-600 p-0.5 text-center"
                style="grid-column: span {{ $asymmetricRight }};"
            >
                <p>1</p>
            </div>
        @else
            @if($columns > 0)
                @foreach(range(1, $columns) as $column)
                    <div class="bg-gray-300 dark:bg-gray-800 rounded-lg border border-dashed border-white dark:border-gray-600 p-0.5 text-center">
                        <p>{{ $column }}</p>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>
