<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use JsonMachine\JsonMachine;

class FillTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = JsonMachine::fromFile('../feed.json');

        foreach ($file as $key => $data) {

            /** @var Post $post */
            $post = Post::firstOrCreate([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'][0]['content'],
                'media' => ''
            ]);

            $categories = array_unique(array_filter(array_merge(
                [
                    Arr::get($data, 'categories.primary')
                ],
                Arr::get($data, 'categories.additional', [])
            )));
            foreach($categories as $idx => $category) {
                $isPrimary = false;
                if ($idx === 0){
                    $isPrimary = true;
                }

                $post->categories()->attach(
                    Category::firstOrCreate(['name' => $category])->id,
                    ['is_primary' => $isPrimary]
                );
            }
        }
    }
}
