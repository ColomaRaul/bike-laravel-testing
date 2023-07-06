<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\OrderType;
use App\Models\ValueObject\Uuid;

interface BikeRepositoryInterface
{
    public function create(Uuid $id, string $name, ?string $description, ?Money $price, ?string $manufacturer): Bike;

    public function searchByCriteria(?string $name, ?string $manufacture, ?string $type, ?OrderType $order): array;
}
