<?php

namespace App\Domain\User\Enums;

enum UserProfileType: string
{
    case INDIVIDUAL = 'individual';
    CASE ENTERPRISE = 'enterprise';
    CASE ADMIN = 'admin';
}
