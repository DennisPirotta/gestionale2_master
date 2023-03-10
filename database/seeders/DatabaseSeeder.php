<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\AccessKey;
use App\Models\Activity;
use App\Models\BusinessHour;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(StaticSeeder::class);

        $me = User::factory()->create([
            'level' => 2,
            'name' => 'Dennis',
            'surname' => 'Pirotta',
            'email' => 'dennispirotta@gmail.com',
            'password' => Hash::make('pellio2014'),
        ])->assignRole('boss', 'user', 'admin', 'developer');
        BusinessHour::init($me);

        AccessKey::factory()->create([
            'key' => Crypt::encryptString('3DAutomation'),
            'name' => 'default',
        ]);
        Customer::factory(10)->create();
        User::factory(20)->create();
        Order::factory(10)->create();
        Activity::factory(20)->create();
        Holiday::factory(50)->create();
        //TechnicalReport::factory(200)->create();
        //Hour::factory(300)->create();
        //Holiday::factory(30)->create();
        //OrderDetails::factory(100)->create();
        //TechnicalReportDetails::factory(100)->create();
        //AccessKey::factory(4)->create();
    }
}
