<?php

namespace App\Domain\User\Entities\ValueObjects\Attributes;

readonly class UserName
{

    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function get(): string { return $this->value; }

    /* getFirstName, getLastName, ...*/
}
