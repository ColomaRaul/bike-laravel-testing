<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Item;

interface ItemRepositoryInterface
{
    public function save(Item $item): void;
}
