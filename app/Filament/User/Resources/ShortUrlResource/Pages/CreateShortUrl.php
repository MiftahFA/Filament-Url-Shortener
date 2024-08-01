<?php

namespace App\Filament\User\Resources\ShortUrlResource\Pages;

use App\Filament\User\Resources\ShortUrlResource;
use AshAllenDesign\ShortURL\Facades\ShortURL as FacadesShortURL;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShortUrl extends CreateRecord
{
    protected static string $resource = ShortUrlResource::class;

    protected function handleRecordCreation(array $data): ShortURL
    {
        return FacadesShortURL::destinationUrl($data['destination_url'])
            ->beforeCreate(function (ShortURL $shortURL) {
                $shortURL->user_id = auth()->id();
            })
            ->make();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
