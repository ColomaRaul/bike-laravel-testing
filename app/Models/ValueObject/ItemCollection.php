<?php
declare(strict_types=1);

namespace App\Models\ValueObject;

use App\Models\Item;

final class ItemCollection
{
    private function __construct(private array $values)
    {
        $this->assertValues($this->values);
    }

    public static function from(array $values): self
    {
        return new self($values);
    }

    public function values(): array
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return array_map(static fn($value) => $value->jsonSerialize(), $this->values());
    }

    private function assertValues(array $values): void
    {
        foreach ($values as $value) {
            if (!$value instanceof Item) {
                throw new \InvalidArgumentException('Invalid argument.');
            }

            $this->values[] = $value;
        }
    }
}