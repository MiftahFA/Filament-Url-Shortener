<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ShortUrlVisitChart extends ChartWidget
{
    protected static ?string $heading = 'Link Visit By Month';

    public $record;
    protected function getData(): array
    {
        $data = Trend::query(ShortURLVisit::where('short_url_id', $this->record->id))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Link Visit Per Month',
                    'data' => $data->pluck('aggregate')->toArray(),
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
