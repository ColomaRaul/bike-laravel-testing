<?php
declare(strict_types=1);

namespace App\Bike\Domain\ValueObject;

use App\Bike\Domain\Model\Item;

final class ItemCollection
{
    public function __construct(private array $values)
    {
        $this->assertValues($this->values);
    }

    public function values(): array
    {
        return $this->values;
    }

    private function assertValues(array $values): void
    {
        foreach ($values as $value) {
            if (!$value instanceof Item::class) {
                throw new \InvalidArgumentException('Invalid argument.');
            }

            $this->values[] = $value;
        }
    }
}