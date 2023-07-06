<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\UI\SearchBikeResponse;
use App\Models\Bike;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\OrderType;
use App\Models\ValueObject\Uuid;
use App\Repositories\BikeRepositoryInterface;
use Illuminate\Support\Facades\Cache;

final class SearchBikeService
{
    private const DEFAULT_TTL_CACHE = 300;

    public function __construct(private BikeRepositoryInterface $bikeRepository)
    {
    }

    public function execute(?string $name, ?string $manufacture, ?string $type, ?string $order): array
    {
        $order = null !== $order ? OrderType::from($order) : null;

        $key = sprintf(
            '%s_%s_%s_%s',
            $name ?? 'all',
            $manufacture ?? 'all',
            $type ?? 'all',
            $order->value ?? 'all',
        );

        $values = Cache::get($key);

        if ($values) {
            return $values;
        }

        $result = $this->bikeRepository->searchByCriteria($name, $manufacture, $type, $order);

        Cache::put($key, $result, self::DEFAULT_TTL_CACHE);

        return $result;
    }
}