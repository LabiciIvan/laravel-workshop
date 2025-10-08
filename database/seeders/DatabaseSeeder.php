<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        Article::factory(50)->create();

        Employer::factory(10)->has(
            Job::factory(5)->hasAttached(
                Tag::factory()->count(2)
            )
        )->create();
    }
}
