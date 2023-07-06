<?php
declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\ValueObject\DateTimeValue;
use App\Models\ValueObject\Uuid;
use App\Repositories\BikeRepositoryInterface;
use App\Services\SearchBikeService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class SearchBikeServiceTest extends TestCase
{
    private SearchBikeService $service;
    private MockObject $bikeRepositoryMock;


    protected function setUp(): void
    {
        $this->bikeRepositoryMock = $this->createMock(BikeRepositoryInterface::class);
        $this->service = new SearchBikeService($this->bikeRepositoryMock);

        parent::setUp();
    }

    public function test_given_no_data_when_execute_service_then_return_all_data(): void
    {
        $bikeId = Uuid::random()->value();
        $this->bikeRepositoryMock->expects($this->once())->method('searchByCriteria')->willReturn([
            [
                'id' => $bikeId,
                'name' => 'Random bike',
                'description' => 'Random description',
                'price' => 29999,
                'manufacturer' => 'Random manufacturer 1',
                'created_at' => DateTimeValue::create()->toAtomString(),
                'updated_at' => DateTimeValue::create()->toAtomString(),
                'items' => [
                    [
                        'id' => Uuid::random()->value(),
                        'bike_id' => $bikeId,
                        'model' => 'Random model 1',
                        'type' => 'Random type 1',
                        'description' => 'Random description 1',
                        'created_at' => DateTimeValue::create()->toAtomString(),
                        'updated_at' => DateTimeValue::create()->toAtomString(),
                    ]
                ]
            ]
        ]);
        $data = $this->service->execute();

        $this->assertIsArray($data);
    }
}