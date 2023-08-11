<?php

namespace Database\Seeders;

use App\Models\EventType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now('utc')->toDateTimeString();

        EventType::insert([
            [
                'code' => 'sport',
                'name' => 'Sport Events',
                'created_at' => $now,
            ],
            [
                'code' => 'concert',
                'name' => 'Music Concert',
                'created_at' => $now,
            ],
            [
                'code' => 'show',
                'name' => 'Show',
                'created_at' => $now,
            ],
            [
                'code' => 'seminar',
                'name' => 'Conference & Seminars',
                'created_at' => $now,
            ],
            [
                'code' => 'exhibition',
                'name' => 'Exhibitions',
                'created_at' => $now,
            ]
        ]);
    }
}
