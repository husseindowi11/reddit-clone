<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TopicSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CommunitiesSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(PostVotesSeeder::class);
    }
}
