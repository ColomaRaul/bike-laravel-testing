<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Bike;
use App\Models\Item;
use App\Models\ValueObject\ItemCollection;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\Uuid;
use App\Repositories\BikeRepositoryInterface;
use App\Repositories\ItemRepositoryInterface;

final class CreateBikeService
{
    public function __construct(
        private BikeRepositoryInterface $bikeRepository,
        private ItemRepositoryInterface $itemRepository,
    ) {
    }

    public function execute(
        Uuid $id,
        string $name,
        string $description,
        float $price,
        string $manufacturer,
        array $items,
    ): void {
        foreach ($items as $item) {
            $item = Item::create(
                [
                    'id' => Uuid::random(),
                    'bike_id' => $id->value(),
                    'model' => $item['model'],
                    'type' => $item['type'],
                    'description' => $item['description'] ?? null,
                ],
            );

            $this->itemRepository->save($item);
        }
        $bike = Bike::create(
            [
                'id' => $id->value(),
                'name' => $name,
                'description' => $description,
                'price' => Money::fromFloat($price)->value(),
                'manufacturer' => $manufacturer,
            ],
        );

        //SAVE bike
//        Cache::put('bike_'.$id->value(), $bike, 60);
        $this->bikeRepository->save($bike);
    }
}