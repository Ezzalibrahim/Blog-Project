<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRaquest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCategory')->only('create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRaquest $request)
    {
        $post =  Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $request->image->store('images', 'public')
        ]);

        if ($request->tags) {
            //! to attach the post to a lot of tags(>=1) 
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Created Successfly');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view(
            'posts.create',
            ['post' => $post, 'categories' => Category::all(), 'tags' => Tag::all()]
        );
        // return view('posts.create')->with('post', Post::find($id))->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // methogde one to update post
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->description = $request->description;


        // methogde tow to update post
        $data_post = $request->only(['title', 'descriprion', 'content']);
        if (isset($request->image)) {
            Storage::disk('public')->delete($post->image);
            $image = $request->image->store('images', 'public');
            $data_post['image'] = $image;
        }
        if ($request->tags) {
            // uodate the tags of the post if it changed
            //! sync = dettach(delete all the tags of the post) + attach(after deattach finish)
            $post->tags()->sync($request->tags);
        }

        $post->update($data_post);

        // with methode pone we use save methode 
        // $post->save();
        session()->flash('success', 'Post Updated Successfly');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id', $id)->first();

        if ($post->trashed()) {
            Storage::disk('public')->delete($post->image);
            $post->forcedelete();
            session()->flash('success', 'Post Deleted Successfly');
        } else {
            $post->delete();
            session()->flash('success', 'Post Trashed Successfly');
        }
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        return view('posts.index')->withPosts(Post::onlyTrashed()->get());
    }
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Post Restored Successfly');
        return redirect(route('posts.index'));
    }
}
