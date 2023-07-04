<?php
declare(strict_types=1);

namespace App\Bike\Domain\Model;

use App\Shared\Domain\ValueObject\DateTimeValue;
use App\Shared\Domain\ValueObject\Uuid;

final class Item
{
    private Uuid $id;
    private string $model;
    private ?string $type;
    private ?string $description;
    private DateTimeValue $createdAt;
    private DateTimeValue $updatedAt;

    public static function create(
        Uuid $id,
        string $model,
        ?string $type,
        ?string $description,
    ): self {
        $self = new self();
        $self->id = $id;
        $self->model = $model;
        $self->type = $type;
        $self->description = $description;
        $self->createdAt = DateTimeValue::create();
        $self->updatedAt = DateTimeValue::create();

        return $self;
    }

    public static function reconstitute(
        Uuid $id,
        string $model,
        ?string $type,
        ?string $description,
        DateTimeValue $createdAt,
        DateTimeValue $updatedAt,
    ): self {
        $self = new self();
        $self->id = $id;
        $self->model = $model;
        $self->type = $type;
        $self->description = $description;
        $self->createdAt = $createdAt;
        $self->updatedAt = $updatedAt;

        return $self;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function createdAt(): DateTimeValue
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValue
    {
        return $this->updatedAt;
    }
}