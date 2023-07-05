<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\ItemCollection;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\Uuid;
use Illuminate\Database\Eloquent\Model;

final class Bike extends Model implements \JsonSerializable
{
    protected $table = 'bike';

    private Uuid $id;
    private string $name;
    private ?string $description;
    private ?Money $price;
    private ?string $manufacturer;
    private ItemCollection $items;
    private DateTimeValue $createdAt;
    private DateTimeValue $updatedAt;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'manufacturer',
        'created_at',
        'updated_at',
    ];

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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'description' => $this->description(),
            'price' => $this->price()->toFloat(),
            'manufacturer' => $this->manufacturer(),
            'items' => $this->items()->jsonSerialize(),
            'created_at' => $this->createdAt()->toAtomString(),
            'updated_at' => $this->updatedAt()->toAtomString(),
        ];
    }
}