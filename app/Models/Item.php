<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

final class Item extends Model implements \JsonSerializable
{
    use HasUuids;

    protected $table = 'item';
    protected $fillable = [
        'id',
        'bike_id',
        'model',
        'type',
        'description',
        'created_at',
        'updated_at',
    ];

    private Uuid $id;
    private Uuid $bikeId;
    private string $model;
    private string $type;
    private ?string $description;
    private DateTimeValue $createdAt;
    private DateTimeValue $updatedAt;

    public function id(): Uuid
    {
        return Uuid::from($this->attributes['id']);
    }

    public function bikeId(): Uuid
    {
        return Uuid::from($this->attributes['bike_id']);
    }

    public function model(): string
    {
        return $this->attributes['model'];
    }

    public function type(): string
    {
        return $this->attributes['type'];
    }

    public function description(): ?string
    {
        return $this->attributes['description'] ?? null;
    }

    public function createdAt(): DateTimeValue
    {
        return DateTimeValue::createFromString($this->attributes['created_at']);
    }

    public function updatedAt(): DateTimeValue
    {
        return DateTimeValue::createFromString($this->attributes['updated_at']);
    }

    public function bike(): mixed
    {
        return $this->belongsTo(Bike::class, 'id');
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'bike_id' => $this->bikeId()->value(),
            'model' => $this->model(),
            'type' => $this->type(),
            'description' => $this->description(),
            'created_at' => $this->createdAt()->toAtomString(),
            'updated_at' => $this->updatedAt()->toAtomString(),
        ];
    }
}