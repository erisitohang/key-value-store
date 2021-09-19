<?php

namespace Tests\Feature;

use App\Models\KeyValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ObjectTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function test_01_can_add_object()
    {
        $objectData = ['testkey' => 'testkey1'];
        $this->json('POST', '/object', $objectData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'testkey' => 'testkey1'
            ]);
    }

    /**
     *
     * @return void
     */
    public function test_02_can_get_object()
    {
        KeyValue::factory()->create([
            'key' => 'testkey',
            'value' => 'testkey1',
            'timestamp' => 1632090362,
        ]);

        $this->json('GET', 'object/testkey', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'testkey' => 'testkey1'
            ]);
    }
}
