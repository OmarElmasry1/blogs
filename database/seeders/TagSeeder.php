<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['php', 'back-end', 'c#', 'node.js'];

        foreach ($tags as $tag) {
            Tag::create([
                'name'=>$tag
            ]);
        }
    }
}
