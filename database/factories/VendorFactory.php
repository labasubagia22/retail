<?php

namespace Database\Factories;

use App\Models\Enterprise;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'enterprise_id' => Enterprise::factory(),
            'name' => $this->faker->name,
        ];
    }
}
