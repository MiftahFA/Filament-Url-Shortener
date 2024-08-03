<?php

namespace App\Filament\User\Resources\ShortUrlResource\Widgets;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ShortUrlVisitPerOperatingSystem extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    public $record;
    protected function getData(): array
    {
        //select browser and agregate on ShortURLVisit table
        $data = ShortURLVisit::select('operating_system', DB::raw('count(operating_system) as total'))
            ->where('short_url_id', $this->record->id)
            ->groupBy('operating_system')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Link Visit Per Operating System',
                    'data' => $data->pluck('total')->toArray(),
                ],
            ],
            'labels' => $data->pluck('operating_system')->toArray()
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
