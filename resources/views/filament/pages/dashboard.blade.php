@vite('resources/css/app.css')
<x-filament-panels::page>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Bem-vindo de volta! 👋</h2>
            <p class="text-gray-600 text-lg">
                Aqui está um resumo do desempenho da sua loja nos últimos bomboklat
            </p>
        </div>
    </div>
    <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-4">
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
    </div>
    <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-4">
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
        @livewire(\App\Filament\Resources\UserResource\Widgets\UsersOverview::class)
    </div>
</x-filament-panels::page>
