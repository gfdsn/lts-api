<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public int $totalProducts;
    protected static ?string $title = "";
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Home';
    protected static string $view = 'filament.pages.dashboard';

    public function mount(): void
    {
        $this->totalProducts = 2;
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
