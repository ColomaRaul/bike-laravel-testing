<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use App\Models\ValueObject\OrderType;

interface BikeRepositoryInterface
{
    public function save(Bike $bike): void;

    public function searchByCriteria(?string $name, ?string $manufacture, ?string $type, ?OrderType $order): array;
}
