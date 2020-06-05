<?php

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
        $tags = ['php', 'ruby'];
        foreach($tags as $tag) App\Models\Tag::create(['name' => $tag]);
    }
}
