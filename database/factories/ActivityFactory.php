<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $actions = [
            'created','updated','deleted'
        ];
        $objects = [
            'the hour','the order','the customer'
        ];
        return [
            'user_id' => User::all()->random()->id,
            'object' => $objects[random_int(0,count($objects) - 1)],
            'action' => $actions[random_int(0,count($actions) - 1)],
            'datetime' => fake()->dateTimeThisMonth,
            'symbolic_id' => random_int(1000,9999),
            'url' => '#'
        ];
    }
}
