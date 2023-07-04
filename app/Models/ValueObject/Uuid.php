<?php
declare(strict_types=1);

namespace App\Models\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

final class Uuid
{
    public function __construct(protected string $value)
    {
        $this->isValidUuid($this->value);
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function isValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException(sprintf('%s does not allow the value %s', self::class, $id));
        }
    }
}