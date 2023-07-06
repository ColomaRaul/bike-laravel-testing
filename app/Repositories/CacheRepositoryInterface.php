<?php
declare(strict_types=1);

namespace App\Repositories;

interface CacheRepositoryInterface
{
    public function save(string $key, mixed $data): void;

    public function get(string $key): mixed;
}