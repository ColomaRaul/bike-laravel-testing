<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ValueObject\OrderType;
use App\Repositories\BikeRepositoryInterface;

final class SearchBikeService
{
    public function __construct(
        private BikeRepositoryInterface $bikeRepository,
    ) {
    }

    public function execute(
        ?string $name = null,
        ?string $manufacture = null,
        ?string $type = null,
        ?string $order = null,
    ): array {
        $order = null !== $order ? OrderType::from($order) : null;

        return $this->bikeRepository->searchByCriteria($name, $manufacture, $type, $order);
    }
}