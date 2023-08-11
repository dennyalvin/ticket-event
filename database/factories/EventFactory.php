<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event_types = ['sport','concert','show','seminar','exhibition'];

        $title = fake()->sentence(4);
        $slug = StringHelper::generateSlug($title);
        return [
            'event_type_code' => $event_types[rand(0, count($event_types)-1)],
            'slug' => $slug,
            'title' => fake()->sentence(4),
            'banner' => 'https://picsum.photos/200/300',
            'description' => fake()->text(300),
            'date_on' => fake()->date(),
            'location_address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'redemption_desc' => fake()->text(300),
            'term_condition' => fake()->text(300),
            'addition_information' => fake()->text(300),
            'status' => 'published',
        ];
    }

}
