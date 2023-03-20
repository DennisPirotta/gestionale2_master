<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'profile_photo_path' => null,
            'current_team_id' => null,
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'holidays' => 160.00,
            'level' => random_int(0, 2),
            'company_id' => Company::inRandomOrder()->first(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn () => ['email_verified_at' => null] );
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam(): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
