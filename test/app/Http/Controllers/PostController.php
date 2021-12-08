<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->with('categories')->first();
        $post->content = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->content,ENT_QUOTES,'UTF-8'))));
        $post->title = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->title,ENT_QUOTES,'UTF-8'))));
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsForCategory($id){
        $category = Category::where('id', $id)->with('posts')->first();

        foreach ($category->posts as $key => $post){
            $post->content = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->content,ENT_QUOTES,'UTF-8'))));
            $post->title = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->title,ENT_QUOTES,'UTF-8'))));
        }

        return response()->json($category->posts);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPosts(Request $request){

//        $posts = Post::with('categories')
//            ->whereRaw(
//            "MATCH(title, content) AGAINST(?)",
//            [$request->search]
//        )->get();

        $category = Category::where('id', $request->id)->with('posts')->first();

        $posts = [];
        if(!empty($request->search)){
            foreach ($category->posts as $key => $post){
                $item = Post::where('id', $post->id)
                    ->whereRaw(
                        "MATCH(title, content) AGAINST(?)",
                        [$request->search]
                    )->first();
                if (!empty($item)){
                    $posts[$key] = $item;
                }
            }
        }
        else{
            $posts = $category->posts;
        }

        foreach ($posts as $key => $post){
            $post->content = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->content,ENT_QUOTES,'UTF-8'))));
            $post->title = strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post->title,ENT_QUOTES,'UTF-8'))));
        }

        return response()->json($posts);
    }
}
