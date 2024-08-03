<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ShortUrlVisitPerBrowser extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    public $record;
    protected function getData(): array
    {
        //get unique browser from ShortURLVisit table and the count of visit according to the browser
        $data = ShortURLVisit::select('browser', DB::raw('count(*) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('browser')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Url Visits By Browser',
                    // convert $data to data array
                    'data' =>  $data->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FF6384'
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            //convert $data to labels array
            'labels' => $data->pluck('browser')->toArray(),

        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'tooltip' => [
                    'enabled' => true,
                ],
                'legend' => [
                    'display' => true,
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                // Configure scales if applicable (for non-pie charts)
                'x' => [
                    'grid' => [
                        'display' => false
                    ],
                    'ticks' => [
                        'display' => false
                    ]
                ],
                'y' => [
                    'grid' => [
                        'display' => false
                    ],
                    'ticks' => [
                        'display' => false
                    ]
                ]
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
