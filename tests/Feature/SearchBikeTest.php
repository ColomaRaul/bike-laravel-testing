<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Middleware\AuthApiMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SearchBikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_given_bikes_when_run_search_bike_endpoint_then_return_ok(): void
    {
        $this->withoutMiddleware(AuthApiMiddleware::class);
        $this->createBikeData();

        $response = $this->getJson('/api/bike/search');
        $responseDecoded = json_decode($response->getContent(), true);

        $this->assertIsArray($responseDecoded);
        $this->assertArrayHasKey('id', $responseDecoded[0]);
        $this->assertArrayHasKey('name', $responseDecoded[0]);
        $this->assertArrayHasKey('description', $responseDecoded[0]);
        $this->assertArrayHasKey('manufacturer', $responseDecoded[0]);
        $this->assertArrayHasKey('items', $responseDecoded[0]);
        $this->assertIsArray($responseDecoded[0]['items']);
        $this->assertArrayHasKey('id', $responseDecoded[0]['items'][0]);
        $this->assertArrayHasKey('bike_id', $responseDecoded[0]['items'][0]);
        $this->assertArrayHasKey('model', $responseDecoded[0]['items'][0]);
        $this->assertArrayHasKey('type', $responseDecoded[0]['items'][0]);
    }

    private function createBikeData(): void
    {
        $dataBikeOne = [
            'name' => 'Random name 1',
            'description' => 'Random description 1',
            'price' => 3999.95,
            'manufacturer' => 'Random manufacturer 1',
            'items' => [
                [
                    'model' => 'Random model 1',
                    'type' => 'Random type 1',
                    'description' => 'Random description 1',
                ],
                [
                    'model' => 'Random model 2',
                    'type' => 'Random type 2',
                    'description' => 'Random description 2',
                ],
                [
                    'model' => 'Random model 3',
                    'type' => 'Random type 3',
                    'description' => 'Random description 3',
                ],
            ],
        ];

        $dataBikeTwo = [
            'name' => 'Random name 2',
            'description' => 'Random description 2',
            'price' => 12999.95,
            'manufacturer' => 'Random manufacturer 2',
            'items' => [
                [
                    'model' => 'Random model 1',
                    'type' => 'Random type 1',
                    'description' => 'Random description 1',
                ],
                [
                    'model' => 'Random model 2',
                    'type' => 'Random type 2',
                    'description' => 'Random description 2',
                ],
            ],
        ];

        $this->postJson('/api/bike/create', $dataBikeOne);
        $this->postJson('/api/bike/create', $dataBikeTwo);
    }
}