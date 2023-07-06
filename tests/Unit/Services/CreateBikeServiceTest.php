<?php
declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\ValueObject\Uuid;
use App\Repositories\BikeRepositoryInterface;
use App\Repositories\ItemRepositoryInterface;
use App\Services\CreateBikeService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateBikeServiceTest extends TestCase
{
    private CreateBikeService $service;
    private MockObject $bikeRepositoryMock;
    private MockObject $itemRepositoryMock;

    protected function setUp(): void
    {
        $this->bikeRepositoryMock = $this->createMock(BikeRepositoryInterface::class);
        $this->itemRepositoryMock = $this->createMock(ItemRepositoryInterface::class);
        $this->service = new CreateBikeService($this->bikeRepositoryMock, $this->itemRepositoryMock);

        parent::setUp();
    }

    public function test_given_correct_data_when_execute_service_then_success(): void
    {
        $id = Uuid::random();
        $name = 'Random Bike';
        $description = 'Random description';
        $price = 222.22;
        $manufacturer = 'Random manufacturer';
        $items = [
            [
                'model' => 'random model 1',
                'type' => 'random type 1',
                'description' => 'random description 1',
            ],
            [
                'model' => 'random model 2',
                'type' => 'random type 2',
                'description' => 'random description 2',
            ],
        ];

        $this->bikeRepositoryMock->expects($this->once())->method('create');
        $this->itemRepositoryMock->expects($this->atLeast(2))->method('create');

        $this->service->execute($id, $name, $description, $price, $manufacturer, $items);
    }

    public function test_given_data_without_items_when_execute_service_then_success(): void
    {
        $id = Uuid::random();
        $name = 'Random Bike';
        $description = 'Random description';
        $price = 222.22;
        $manufacturer = 'Random manufacturer';

        $this->bikeRepositoryMock->expects($this->once())->method('create');
        $this->itemRepositoryMock->expects($this->never())->method('create');

        $this->service->execute($id, $name, $description, $price, $manufacturer, []);
    }
}