<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;
    public Model | int | string | null $record;

    public function getTitle(): string
    {
        return "Editing: ".$this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data["slug"] = Str::slug($data["title"]);
        $data["quotation"]["price"] = $data["quotation"]["price"] * 100;
        $data["quotation"]["final_price"] = $data["quotation"]["price"] - ($data["quotation"]["price"] * ($data["quotation"]["discount_value"] / 100));

        return $data;
    }
}
