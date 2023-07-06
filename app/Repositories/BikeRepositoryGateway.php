<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Bike;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\OrderType;
use App\Models\ValueObject\Uuid;

final class BikeRepositoryGateway implements BikeRepositoryInterface
{
    public function __construct(
        private BikeRepository $bikeRepository,
        private CacheRepositoryInterface $cacheRepository,
    ) {
    }

    public function create(Uuid $id, string $name, ?string $description, ?Money $price, ?string $manufacturer): Bike
    {
        return $this->bikeRepository->create($id, $name, $description, $price, $manufacturer);
    }

    public function searchByCriteria(?string $name, ?string $manufacture, ?string $type, ?OrderType $order): array
    {
        $key = sprintf(
            '%s_%s_%s_%s',
            $name ?? 'all',
            $manufacture ?? 'all',
            $type ?? 'all',
            $order->value ?? 'all',
        );

        $cachedValues = $this->cacheRepository->get($key);

        if ($cachedValues) {
            return $cachedValues;
        }

        $result = $this->bikeRepository->searchByCriteria($name, $manufacture, $type, $order);

        $this->cacheRepository->save($key, $result);

        return $result;
    }
}