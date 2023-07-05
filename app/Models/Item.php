<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\Uuid;
use Illuminate\Database\Eloquent\Model;

final class Item extends Model implements \JsonSerializable
{
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

    public static function reconstitute(
        Uuid $id,
        Uuid $bikeId,
        string $model,
        string $type,
        ?string $description,
        DateTimeValue $createdAt,
        DateTimeValue $updatedAt,
    ): self {
        $self = new self();
        $self->id = $id;
        $self->bikeId = $bikeId;
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

    public function bikeId(): Uuid
    {
        return $this->bikeId;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function type(): string
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
            'bike_id' => $this->bikeId()->value(),
            'model' => $this->model(),
            'type' => $this->type(),
            'description' => $this->description(),
            'created_at' => $this->createdAt()->toAtomString(),
            'updated_at' => $this->updatedAt()->toAtomString(),
        ];
    }
}