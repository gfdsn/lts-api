<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Domain\Product\Interfaces\ProductServiceInterface;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductsOverview extends BaseWidget
{

    public string $totalProducts;
    public string $totalProductsMonthly;
    public string $increasePercentage; // based on last month
    protected static string $view = 'filament.widgets.products_overview';

    public function mount(): void
    {
        $productService = app(ProductServiceInterface::class);
        $monthlyStats = $productService->monthlyStats();

        $this->totalProducts = $monthlyStats["totalProducts"];
        $this->totalProductsMonthly = $monthlyStats["monthlyProductsCount"];
        $this->increasePercentage = $monthlyStats["monthlyIncreasePercentage"];
    }
}
