<?php

namespace Database\Factories;

use App\Models\KeyValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeyValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KeyValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->text(8),
            'value' => $this->faker->text(30),
            'timestamp' => Carbon::now()->timestamp
        ];
    }
}
