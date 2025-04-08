<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('userprofile')
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->get();

        return $this->Ok($posts, "Posts have been retrieved");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        // if (isset($inputs['description'])) {
        //     $inputs['description'] = $inputs['description']->trim();
        // }

        $validator = validator()->make($inputs, [
            "created_by" => "required|integer|min:1|max:9",
            "description" => "required|string|max:255",
            "media_link" => "sometimes|string",
            "thumbnail_link" => "sometimes|string",
        ]);

        if ($validator->fails()) 
        {
            return $this->BadRequest($validator, "Error creating post!");
        }

        $post = Post::create($validator->validated());

        return $this->Created($post, "Post by user id: $post->id has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (empty($post)) 
        {
            return $this->NotFound("Post id $id does not exist!");
        }

        $inputs = $request->all();

        $validator = validator()->make($inputs, [
            "created_by" => "sometimes|integer|min:1|max:9",
            "description" => "sometimes|string|max:255",
            "media_link" => "sometimes|string",
            "thumbnail_link" => "sometimes|string",
        ]);

        if ($validator->fails()) 
        {
            return $this->BadRequest($validator, "Error updating post!");
        }

        $post->update($validator->validated());

        return $this->Ok($post, "Post id: $id has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $post = Post::find($id);

        if (empty($post)) 
        {
            return $this->NotFound("Post id $id does not exist!");
        }

        $post->delete();

        return $this->Ok($post, "Post id: $id has been deleted!");
    }
}
