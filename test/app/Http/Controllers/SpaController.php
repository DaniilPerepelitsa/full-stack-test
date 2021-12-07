<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use JsonMachine\JsonMachine;

class SpaController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function test(){

        $file = JsonMachine::fromFile('../../feed.json');

        $posts = [];
        $categories = [];

        foreach ($file as $key => $data) {

            $posts[$key] = Post::firstOrCreate([
//                'id' => $data['id'],
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
                $categories[$idx] = Category::firstOrCreate(['name' => $category, 'is_primary' => $isPrimary]);


                PostCategories::firstOrCreate([
                    'post_id' => $posts[$key]->id,
                    'category_id' => $categories[$idx]->id,
                ]);
            }
        }
    }
}
