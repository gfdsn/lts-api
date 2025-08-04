@vite('resources/css/app.css')
<div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex rounded-lg text-gray-400">
            <x-heroicon-o-user class="h-5 w-6 "/>
            <p class="text-sm mb-1">Total Users</p>
        </div>
        <div class="flex items-center gap-1 text-sm text-green-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7H7"></path>
            </svg>
            <p>{{$increasePercentage}}%</p>
        </div>
    </div>
    <div>
        <h3 class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</h3>

        <p class="text-xs text-gray-400 mt-3">+{{ $totalUsersMonthly }} este mês</p>
    </div>
</div>
