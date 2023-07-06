<?php
declare(strict_types=1);

namespace App\Services;

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
        Uuid $bikeId,
        string $name,
        string $description,
        float $price,
        string $manufacturer,
        array $items,
    ): void {
        $this->bikeRepository->create($bikeId, $name, $description, Money::fromFloat($price), $manufacturer);

        foreach ($items as $item) {
            $this->itemRepository->create(Uuid::random(), $bikeId, $item['model'], $item['type'], $item['description'] ?? null);
        }
    }
}