<?php

namespace App\Http\Controllers;

use App\Posts;
use App\tag;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function tagchart()
    {
        $tags = tag::all();
        foreach ($tags as $tag)
        {
            $data[] = [$tag_name[] = $tag->name,
            $tag_post_count[] = $tag->posts()->count(),
            ];
        }
        return json_encode($data);
    }

    public function postchart()
    {
        $posts = Posts::all();
        foreach ($posts as $post)
        {
            $data[] =[
                $post_title[] = $post->title,
                $post_view[] = $post->view,
            ];
        }
        return response()->json($data);

    }
}
