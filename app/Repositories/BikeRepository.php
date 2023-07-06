<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\OrderType;
use App\Models\ValueObject\Uuid;

final class BikeRepository implements BikeRepositoryInterface
{
    public function create(Uuid $id, string $name, ?string $description, ?Money $price, ?string $manufacturer): Bike
    {
        return Bike::create(
            [
                'id' => $id->value(),
                'name' => $name,
                'description' => $description,
                'price' => $price->value(),
                'manufacturer' => $manufacturer,
            ],
        );
    }

    public function searchByCriteria(?string $name, ?string $manufacture, ?string $type, ?OrderType $order): array
    {
        $bikesQuery = Bike::with('items');

        if ($name) {
            $bikesQuery->where('bike.name', 'LIKE', '%'.$name.'%');
        }

        if ($manufacture) {
            $bikesQuery->where('bike.manufacturer','LIKE', '%'.$manufacture.'%');
        }

        if ($type) {
            $bikesQuery->whereHas('items', function ($query) use ($type) {
                $query->where('item.type', 'LIKE', '%'.$type.'%');
            });
        }

        if ($order) {
            $bikesQuery->orderBy('bike.name', $order->value);
        }

        return $bikesQuery->get()->all();
    }
}