<?php
declare(strict_types=1);

namespace App\Models\ValueObject;

enum OrderType: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}