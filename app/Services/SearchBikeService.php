<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ValueObject\Uuid;
use Illuminate\Support\Facades\Cache;

final class SearchBikeService
{
    public function execute(?string $name, ?string $manufacture, ?string $type, ?string $order): array
    {

        $key = sprintf(
            '%s_%s_%s_%s',
            $name ?? 'all',
            $manufacture ?? 'all',
            $type ?? 'all',
            $order ?? 'all',
        );

        $values = Cache::get($key);

        if ($values) {
            return $values;
        }

        // BUSCAR EN EL REPO
        return [];
    }
}