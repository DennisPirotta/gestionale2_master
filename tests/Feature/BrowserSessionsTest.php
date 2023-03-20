<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\StaticSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Livewire\Livewire;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = StaticSeeder::class;
    protected $seed = true;

    public function test_other_browser_sessions_can_be_logged_out(): void
    {
//        $this->seed(StaticSeeder::class);

        $this->actingAs($user = User::factory()->create());

        Livewire::test(LogoutOtherBrowserSessionsForm::class)
                ->set('password', 'password')
                ->call('logoutOtherBrowserSessions')
                ->assertSuccessful();
    }
}
