<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\Uuid;

final class Item implements \JsonSerializable
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'model' => $this->model(),
            'type' => $this->type(),
            'description' => $this->description(),
            'created_at' => $this->createdAt()->toAtomString(),
            'updated_at' => $this->updatedAt()->toAtomString(),
        ];
    }
}