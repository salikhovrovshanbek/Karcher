<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karcher;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $karcher=Karcher::factory(100)->create();
        Karcher::factory(10)
            ->hasAttached(User::factory(10))
            ->create();

        User::factory(20)->for(Karcher::factory(10))->create();
        User::factory(20)->for($karcher)->create();
        //User::factory(20,'karchers')->for(Karcher::factory())->create();
//        User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//        ]);
    }
}
