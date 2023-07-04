<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Bike;
use App\Models\Item;
use App\Models\ValueObject\ItemCollection;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\Uuid;
use Illuminate\Support\Facades\Cache;

final class CreateBikeService
{
    public function __construct()
    {
    }

    public function execute(
        Uuid $id,
        string $name,
        string $description,
        float $price,
        string $manufacturer,
        array $items,
    ): void {
        $itemsCollection = [];
        foreach ($items as $item) {
            $itemsCollection[] = Item::create(
                Uuid::random(),
                $item['model'],
                $item['type'] ?? null,
                $item['description'] ?? null,
            );
        }

        $bike = Bike::create(
            $id,
            $name,
            $description,
            Money::fromFloat($price),
            $manufacturer,
            ItemCollection::from($itemsCollection),
        );

        //SAVE bike
        Cache::put('bike_'.$id->value(), $bike, 60);
    }
}