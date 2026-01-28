<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        









        DB::table('services')->insert([
            'name' => 'Cleaning Services',
            'description' => 'includes residential cleaning, deep cleaning, commercial cleaning, window washing',
            'base_price' => 200.00,
            'duration_minutes' => 00,
        ]);
            DB::table('services')->insert([
            'name' => 'Handyman & Repair',
            'description' => 'includes general repairs, plumbing, electrical appliance repair, locksmith services',
            'base_price' => 350.20,
            'duration_minutes' => 00,

        ]);

            DB::table('services')->insert([
            'name' => 'Pet Services',
            'description' => 'includes pet sitting, dog sitting, dog walking, grooming',
            'base_price' => 50.50,
            'duration_minutes' => 00,

        ]);

            DB::table('services')->insert([
            'name' => 'Outdoor Services',
            'description' => 'includes landscaping, lawn care, pool services, power washing, snow removal',
            'base_price' => 70.50,
            'duration_minutes' => 00,

        ]);

            DB::table('services')->insert([
            'name' => 'Moving & Storage',
            'description' => 'includes local moving, junk removal, packing services',
            'base_price' => 300.00,
            'duration_minutes' => 00,

        ]);

            DB::table('services')->insert([
            'name' => 'Event Services',
            'description' => 'includes Catering, event planning, photograph',
            'base_price' => 1000.00,
            'duration_minutes' => 00,

        ]);




        
    }
}
