@vite('resources/css/app.css')
<x-filament-panels::page>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back! 👋</h2>
            <p class="text-gray-600 text-lg">
                Below, there's a brief resume on how you've been doing this month.
            </p>
        </div>
    </div>
    <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-4">
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
        @livewire(\App\Filament\Resources\ProductResource\Widgets\ProductsOverview::class)
        @livewire(\App\Filament\Resources\ProductResource\Widgets\ProductsOverview::class)
    </div>
</x-filament-panels::page>
