<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Item;
use App\Models\ValueObject\Uuid;

final class ItemRepository implements ItemRepositoryInterface
{
    public function create(Uuid $id, Uuid $bikeId, string $model, string $type, ?string $description): Item
    {
        return Item::create(
            [
                'id' => $id->value(),
                'bike_id' => $bikeId->value(),
                'model' => $model,
                'type' => $type,
                'description' => $description,
            ]
        );
    }
}