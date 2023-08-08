<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /*             $table->jsonb('name');
            $table->string('code');
            $table->string('encoding');
            $table->string('image')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(false); */
    public function definition(): array
    {
        return [
            'name' => ['en'=> 'ua','uk'=>'укр'],
            'code' => 'uk',
            'encoding' =>'uk-ua',
            'image' => fake()->image(),
            'is_default' => true,
            'status' => true,
        ];
    }


}
