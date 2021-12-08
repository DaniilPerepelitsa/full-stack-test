<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function getPostsForCategory(int $id){
        $posts = Category::find($id)->posts()->paginate(5)->toArray();

        $posts['data'] = array_map(function (array $post){
            return [
                'id' => $post['id'],
                'slug' => $post['slug'],
                'title' => strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post['title'],ENT_QUOTES,'UTF-8')))),
                'content' => strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post['content'],ENT_QUOTES,'UTF-8')))),
                "media" => "",
                "created_at" => $post['created_at'],
                "updated_at" => $post['updated_at'],
            ];
        },$posts['data']);

        return response()->json($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchPosts(Request $request){

        if(!empty($request->search)){
            $posts = Category::find($request->id)->posts()->whereRaw(
                "MATCH(title, content) AGAINST(?)",
                [$request->search]
            )->paginate(5)->toArray();

        }
        else{
            $posts = Category::find($request->id)->posts()->paginate(5)->toArray();
        }

        $posts['data'] = array_map(function (array $post){
            return [
                'id' => $post['id'],
                'slug' => $post['slug'],
                'title' => strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post['title'],ENT_QUOTES,'UTF-8')))),
                'content' => strip_tags(preg_replace('/<[^>]*>/','', str_replace(array("&nbsp;","\n","\r"),"", html_entity_decode($post['content'],ENT_QUOTES,'UTF-8')))),
                "media" => "",
                "created_at" => $post['created_at'],
                "updated_at" => $post['updated_at'],
            ];
        },$posts['data']);
        return response()->json($posts);
    }
}
