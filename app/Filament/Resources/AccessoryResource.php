<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessoryResource\Pages;
use App\Filament\Resources\AccessoryResource\RelationManagers;
use App\Infrastructure\Persistence\Product\Subdomains\Accessory\Models\AccessoryModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class AccessoryResource extends Resource
{
    protected static ?string $model = AccessoryModel::class;

    protected static ?string $label = 'Accessories';
    protected static ?string $navigationLabel = 'Accessories';
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(5)
                    ->schema([
                        Forms\Components\Placeholder::make('image')
                            ->label('')
                            ->content(new HtmlString('
                        <img src="https://shorturl.at/jXWvD"
                             alt="bomboklat"
                             class="w-full h-full object-contain mt-6" />
                    '))
                            ->extraAttributes(['class' => 'flex items-center justify-center w-full h-full']),

                        Forms\Components\Fieldset::make('Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')->label('Name')->columnSpan(2),
                                Forms\Components\TextInput::make('details')->label('Details')->columnSpan(2),
                            ])
                            ->columnSpan(4)
                            ->extraAttributes(['class' => 'h-full']),
                    ]),

                Forms\Components\Fieldset::make('Quotation')
                    ->schema([
                        Forms\Components\TextInput::make('price')->numeric()->minValue(0)->label('Price'),
                        Forms\Components\TextInput::make('stock')->integer()->minValue(0)->label('Stock'),
                    ]),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('details')
                    ->label('Details')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state."€"),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAccessories::route('/'),
            'create' => Pages\CreateAccessory::route('/create'),
            'edit' => Pages\EditAccessory::route('/{record}/edit'),
        ];
    }
}
