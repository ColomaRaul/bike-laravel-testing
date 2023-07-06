<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use App\Models\ValueObject\OrderType;
use Illuminate\Database\Eloquent\Collection;

final class BikeRepository implements BikeRepositoryInterface
{
    public function save(Bike $bike): void
    {
        $bike->save();
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