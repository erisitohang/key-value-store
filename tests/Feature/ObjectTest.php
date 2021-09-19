<?php

namespace Tests\Feature;

use App\Models\KeyValue;
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
     * Test Get object
     * @return void
     */
    public function test_02_can_get_object()
    {
        KeyValue::factory()->create([
            'key' => 'testkey',
            'value' => 'testkey1',
            'timestamp' => 1632090100,
        ]);

        // Get value from testkey
        $this->json('GET', 'object/testkey', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'testkey' => 'testkey1'
            ]);

        KeyValue::factory()->create([
            'key' => 'testkey',
            'value' => 'testkey2',
            'timestamp' => 1632090200,
        ]);

        // Get latest value from testkey
        $this->json('GET', 'object/testkey', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'testkey' => 'testkey2'
            ]);

        // Get value from testkey on timestamp=1632090110
        $this->json('GET', 'object/testkey?timestamp=1632090110', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'testkey' => 'testkey1'
            ]);

    }

    /**
     * Test get all object from database
     *
     * @return void
     */
    public function test_02_can_get_all_object()
    {
        $keys = KeyValue::factory()->count(3)->create();

        $this->json('GET', 'object/get_all_records', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonCount(3);
    }
}
