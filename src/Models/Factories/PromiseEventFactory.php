<?php

namespace Tochka\Promises\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tochka\Promises\Models\PromiseEvent;

/**
 * @codeCoverageIgnore
 * @template-extends Factory<PromiseEvent>
 */
class PromiseEventFactory extends Factory
{
    protected $model = PromiseEvent::class;

    public function definition(): array
    {
        return [
            'job_id' => $this->faker->randomNumber(5),
            'event_name' => 'MyEvent',
            'event_unique_id' => $this->faker->randomNumber(5),
        ];
    }
}
