<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ShortUrlResource\Pages;
use App\Filament\User\Resources\ShortUrlResource\RelationManagers;
use App\Models\MyShortUrl;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShortUrlResource extends Resource
{
    protected static ?string $model = MyShortUrl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //add text input for destination_url
                TextInput::make('destination_url')
                    ->label('Destination URL')
                    ->required()
                    ->placeholder('https://example.com'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //add column for destination_url
                TextColumn::make('destination_url')
                    ->searchable()
                    ->sortable(),
                //add column for url_key
                TextColumn::make('url_key')
                    ->searchable()
                    ->sortable(),
                //add column for image
                ImageColumn::make('image')
                    ->label('QR Code')
                    ->alignCenter()
                    ->disk('qrcode')
                    ->size(100)
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->inlineLabel()
            ->schema([
                Section::make('Details')->schema([
                    TextEntry::make('destination_url')
                        ->label('Destination URL'),
                    TextEntry::make('default_short_url')
                        ->label('Default Short URL')
                        ->url(fn (MyShortUrl $record): string => url($record->default_short_url))
                        ->openUrlInNewTab(),
                    ImageEntry::make('image')->label('QR Code')->disk('qrcode')->size(200),
                ]),
                //add new section name it analytics
                Section::make('Analytics')
                    ->schema([
                        ViewEntry::make('stats_overview')
                            ->view('widget.short-url.stats-overview')
                            ->label('Overview'),
                        Split::make([
                            ViewEntry::make('visit_chart')
                                ->view('widget.short-url.visit'),
                            ViewEntry::make('visit_chart')
                                ->view('widget.short-url.visit-by-os'),
                            ViewEntry::make('visit_chart')
                                ->view('widget.short-url.visit-by-browser'),
                        ])
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShortUrls::route('/'),
            'create' => Pages\CreateShortUrl::route('/create'),
            'view' => Pages\ViewShortUrl::route('/{record}'),
            'edit' => Pages\EditShortUrl::route('/{record}/edit'),
        ];
    }
}
