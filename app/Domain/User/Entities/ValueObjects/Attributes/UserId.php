<?php

namespace App\Domain\User\Entities\ValueObjects\Attributes;

use Illuminate\Support\Str;

readonly class UserId
{
    private string $value;

    private function __construct(string $id)
    {
        $this->value = $id;
    }

    public function toString(): string
    {
        return $this->value;
    }
    public static function generate(): self
    {
        return new self(Str::uuid()->toString());
    }
    public static function fromString(string $uuid): self
    {
        return new self($uuid);
    }
    public function equals(string $testUuid): bool
    {
        $valueAsUuid = self::fromString($testUuid);

        return $this->value == $valueAsUuid->toString();
    }
    /* ... */
}
