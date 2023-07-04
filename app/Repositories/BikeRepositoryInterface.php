<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;

interface BikeRepositoryInterface
{
    public function save(Bike $bike): void;

    public function searchByCriteria(): array;
}
