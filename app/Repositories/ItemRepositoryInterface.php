<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Item;
use App\Models\ValueObject\Uuid;

interface ItemRepositoryInterface
{
    public function create(Uuid $id, Uuid $bikeId, string $model, string $type, ?string $description): Item;
}
