<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Domain\User\Interfaces\UserServiceInterface;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UsersOverview extends BaseWidget
{

    public string $totalUsers;
    public string $totalUsersMonthly;
    public string $increasePercentage; // based on last month
    protected static string $view = 'filament.widgets.users_overview';

    public function mount(): void
    {
        $userService = app(UserServiceInterface::class);

        $this->totalUsers = count($userService->getAll());
        $this->totalUsersMonthly = "10,000";
        $this->increasePercentage = "12,5";
    }
}
