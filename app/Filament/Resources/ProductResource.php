<?php

namespace App\Filament\Resources;

use App\Domain\Product\Subdomains\Accessory\Interfaces\AccessoryServiceInterface;
use App\Domain\Product\Subdomains\Category\Interfaces\CategoryServiceInterface;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Infrastructure\Persistence\Product\Models\ProductModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class ProductResource extends Resource
{
    protected static ?string $model = ProductModel::class;
    protected static ?string $label = 'Products';
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        $categoryService = app(CategoryServiceInterface::class);
        $accessoriesService = app(AccessoryServiceInterface::class);

        return $form
            ->schema([
                Forms\Components\Fieldset::make('Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(50)
                            ->columnSpan(2),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        Forms\Components\Select::make('classification.category_id')
                            ->label('Category')
                            ->placeholder("Select a category")
                            ->options($categoryService->getAll()->pluck("name", "id")->toArray())
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('classification.subcategory_id')
                            ->label('Sub Category')
                            ->placeholder("Select a sub category")
                            ->options($categoryService->getAll()->pluck("name", "id")->toArray())
                            ->searchable()
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make('Quotation')
                    ->schema([
                        Forms\Components\TextInput::make('quotation.price')
                            ->label('Price (€)')
                            ->required()
                            ->numeric()
                            ->formatStateUsing(fn ($state) => number_format(($state / 100), 2))
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                $discount = $get('quotation.discount_value') ?? 0;
                                $set('quotation.final_price', number_format($state - ($state * ($discount / 100)), 2));
                            }),
                        Forms\Components\TextInput::make('quotation.discount_value')
                            ->label('Discount (%)')
                            ->minValue(0)
                            ->maxValue(99)
                            ->required()
                            ->integer()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                $price = $get('quotation.price') ?? 0;
                                $set('quotation.final_price', number_format($price - ($price * ($state / 100)), 2));
                            }),
                        Forms\Components\TextInput::make('quotation.final_price')
                            ->label("Projected Final Price (€)")
                            ->disabled()
                            ->required()
                            ->numeric()
                            ->dehydrated(false)
                            ->formatStateUsing(fn ($state) => number_format(($state / 100), 2))
                        ])->columns(3),
                Forms\Components\Fieldset::make('Measures')
                    ->schema([
                            Forms\Components\TextInput::make('measures.length')
                                ->label('Length (cm)')
                                ->required()
                                ->minValue(0)
                                ->integer(),
                            Forms\Components\TextInput::make('measures.width')
                                ->label("Width (cm)")
                                ->required()
                                ->minValue(0)
                                ->integer(),
                            Forms\Components\TextInput::make('measures.height')
                                ->label("Height (cm)")
                                ->required()
                                ->minValue(0)
                                ->integer(),
                        ])->columns(3),
                Forms\Components\Fieldset::make('Attributes')
                    ->schema([
                        Forms\Components\TextInput::make('attributes.weight')
                            ->label('Weight (g)')
                            ->minValue(0)
                            ->required()
                            ->integer(),
                        Forms\Components\TextInput::make('attributes.color')
                            ->label("Color")
                            ->required()
                ]),
                Forms\Components\Fieldset::make('Availability')
                    ->schema([
                            Forms\Components\TextInput::make('stock')
                                ->label('Stock')
                                ->required()
                                ->minValue(0)
                                ->integer(),
                            Forms\Components\Toggle::make('visibility')
                                ->label("Visible")
                                ->required()
                                ->inline(false) // puts label under toggle if you prefer
                    ]),
                Forms\Components\Fieldset::make('Accessories')
                    ->schema([
                        Forms\Components\Select::make('accessories')
                            ->label("")
                            ->multiple()
                            ->minItems(1)
                            ->options($accessoriesService->getAll()->pluck('name', 'id')->toArray())
                            ->placeholder('Add an accessory')
                            ->afterStateHydrated(function ($set, $state) {
                                $set('accessories', Arr::pluck($state, "id"));
                            })
                            ->columnSpan(2)
                    ]),
                Forms\Components\Fieldset::make('Images')
                    ->schema((function () use ($form) {
                        $record = $form->getRecord();

                        $fields = [];
                        foreach ($record->images as $ignored) {
                            $fields[] = Forms\Components\Placeholder::make('')
                                ->content(new HtmlString('<img src="https://shorturl.at/jXWvD" alt="bomboklat" />'));
                        }
                        return $fields;
                    })())
                    ->columns(3),
                Forms\Components\Fieldset::make('Documentation')
                    ->schema((function () use ($form) {
                        return [
                            Forms\Components\FileUpload::make('documentation')
                            ->label("")
                            ->multiple()
                            ->previewable(false)
                            ->preserveFilenames(),
                        ];
                    })())
                    ->columns(3),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_category.name')
                    ->label('Sub Category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quotation.final_price')
                    ->label('Final Price')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => (number_format($state / 100, 2))."€"),
                Tables\Columns\TextColumn::make('quotation.price')
                    ->label('Price')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => (number_format($state / 100, 2))."€"),
                Tables\Columns\TextColumn::make('quotation.discount_value')
                    ->label('Discount')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state."%"),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),
                Tables\Columns\IconColumn::make('visibility')
                    ->boolean()
                    ->label('Visibility'),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }


}
