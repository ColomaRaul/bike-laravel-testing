<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Item;

final class ItemRepository implements ItemRepositoryInterface
{
    public function save(Item $item): void
    {
        $item->save();
    }
}