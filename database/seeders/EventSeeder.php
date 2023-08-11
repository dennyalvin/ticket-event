<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Promoter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = $this->makeUser();
        $promoter = $this->makePromoter($user);

        Event::factory()
            ->count(10)
            ->for($promoter)
            ->hasGalleries(2)
            ->hasPackages(2)
            ->create();
    }

    private function makeUser()
    {
        $user = \App\Models\User::create([
            'first_name' => 'Denny',
            'last_name' => 'Saputra',
            'email' => 'dennyalvin23@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '6281381789175',
            'is_promoter' => 1,
        ]);

        return $user;
    }

    private function makePromoter($user)
    {
        $promoter = \App\Models\Promoter::create([
            'user_id' => $user->id,
            'company_name' => 'Dewa Promoter',
            'slug' => 'dewa-promoter'
        ]);

        return $promoter;
    }
}
