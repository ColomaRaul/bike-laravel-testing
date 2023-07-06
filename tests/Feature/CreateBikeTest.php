<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Middleware\AuthApiMiddleware;
use Tests\TestCase;

class CreateBikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_given_bike_data_when_run_create_bike_endpoint_then_return_ok(): void
    {
        $this->withoutMiddleware(AuthApiMiddleware::class);

        $data = [
            'name' => 'Random name 1',
            'description' => 'Random description 1',
            'price' => 3999.95,
            'manufacturer' => 'Random manufacturer',
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
            ] ,
        ];

        $response = $this->postJson('/api/bike/create', $data);
        $responseDecoded = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $responseDecoded);
    }
}