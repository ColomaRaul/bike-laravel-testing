<?php
declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

final class CacheRepository implements CacheRepositoryInterface
{
    private const DEFAULT_TTL_CACHE = 300;

    public function save(string $key, mixed $data): void
    {
        Cache::put($key, $data, self::DEFAULT_TTL_CACHE);
    }

    public function get(string $key): mixed
    {
        return Cache::get($key);
    }
}