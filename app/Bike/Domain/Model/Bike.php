<?php
declare(strict_types=1);

namespace App\Bike\Domain\Model;

use App\Bike\Domain\ValueObject\ItemCollection;
use App\Shared\Domain\ValueObject\DateTimeValue;
use App\Shared\Domain\ValueObject\Money;
use App\Shared\Domain\ValueObject\Uuid;

final class Bike
{
    private Uuid $id;
    private string $name;
    private ?string $description;
    private ?Money $price;
    private ?string $manufacturer;
    private ItemCollection $items;
    private DateTimeValue $createdAt;
    private DateTimeValue $updatedAt;

    public function __construct()
    {
    }

    public static function create(
        Uuid $id,
        string $name,
        ?string $description,
        ?Money $price,
        ?string $manufacturer,
        ItemCollection $items,
    ): self {
        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->description = $description;
        $self->price = $price;
        $self->manufacturer = $manufacturer;
        $self->items = $items;
        $self->createdAt = DateTimeValue::create();
        $self->updatedAt = DateTimeValue::create();

        return $self;
    }

    public static function reconstitute(
        Uuid $id,
        string $name,
        ?string $description,
        ?Money $price,
        ?string $manufacturer,
        ItemCollection $items,
        DateTimeValue $createdAt,
        DateTimeValue $updatedAt,
    ): self {
        $self = new self();
        $self->id = $id;
        $self->name = $name;
        $self->description = $description;
        $self->price = $price;
        $self->manufacturer = $manufacturer;
        $self->items = $items;
        $self->createdAt = $createdAt;
        $self->updatedAt = $updatedAt;

        return $self;
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function price(): ?Money
    {
        return $this->price;
    }

    public function manufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function items(): ItemCollection
    {
        return $this->items;
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