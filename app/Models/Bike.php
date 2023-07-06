<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\Money;
use App\Models\ValueObject\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model implements \JsonSerializable
{
    use HasUuids;

    protected $table = 'bike';

    private Uuid $id;
    private string $name;
    private ?string $description;
    private ?Money $price;
    private ?string $manufacturer;
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

    public function id(): Uuid
    {
        return Uuid::from($this->attributes['id']);
    }

    public function name(): string
    {
        return $this->attributes['name'];
    }

    public function description(): ?string
    {
        return $this->attributes['description'] ?? null;
    }

    public function price(): ?Money
    {
        return null !== $this->attributes['price'] ? Money::from($this->attributes['price']) : null;
    }

    public function manufacturer(): ?string
    {
        return $this->attributes['manufacturer'] ?? null;
    }

    public function items(): mixed
    {
        return $this->hasMany(Item::class, 'bike_id');
    }

    public function itemsToJson(): array
    {
        return $this->items()->map(function ($item) {
            return $item->jsonSerialize();
        })->toJson();
    }

    public function createdAt(): DateTimeValue
    {
        return DateTimeValue::createFromString($this->attributes['created_at']);
    }

    public function updatedAt(): DateTimeValue
    {
        return DateTimeValue::createFromString($this->attributes['updated_at']);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'description' => $this->description(),
            'price' => $this->price()->toFloat(),
            'manufacturer' => $this->manufacturer(),
            'items' => $this->items()->getModels(),
            'created_at' => $this->createdAt()->toAtomString(),
            'updated_at' => $this->updatedAt()->toAtomString(),
        ];
    }
}