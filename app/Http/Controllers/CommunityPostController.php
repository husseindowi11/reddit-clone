<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use App\Notifications\PostReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Community $community)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Community $community)
    {
        $image = null;

        if ($request->hasFile('post_image')){
            $image  = $request->file('post_image')->store('posts');
            $file = Image::make(storage_path('app/public/' . $image));
            $file->resize(600, 400);
            $file->save();
        }

        $community->posts()->create([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'user_id' => auth()->id(),
            'post_image' => $image,
        ]);
        return redirect()->route('communities.show', compact('community'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community, Post $post)
    {
        $post->load('comments.user')->latest();
        return view('posts.show', compact('community','post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)){
            abort(403);
        }
        return view('posts.edit', compact('community','post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)){
            abort(403);
        }
        $image = $post->post_image;
        if ($request->hasFile('post_image')){
            $image  = $request->file('post_image')->store('posts');
            if (!empty($post->post_image && $image != $post->post_image)){
                unlink(storage_path('app/public/'.$post->post_image));
            }
            $file = Image::make(storage_path('app/public/' . $image));
            $file->resize(600, null);
            $file->save();
        }

        $post->update([
            'title' => $request->title,
            'post_text' => $request->post_text,
            'user_id' => auth()->id(),
            'post_image' => $image,
            ]);
        return redirect()->route('communities.posts.show', compact('community', 'post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community, Post $post)
    {
        if (Gate::denies('delete-post',  $post)){
            abort(403);
        }
        $post->delete();
        return redirect()->route('communities.show', compact('community'));
    }

    public function vote($post_id, $vote)
    {
        $post = Post::with('community')->findOrFail($post_id);

        if (
            !PostVote::where('post_id', $post_id)->where('user_id', auth()->id())->count() and
            in_array($vote, [-1,1]) and $post->user_id != auth()->id()
        ) {
            PostVote::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);
        }
        return redirect()->route('communities.show', $post->community);
    }

    public function report($post_id)
    {
        $post = Post::with('community.user')->findOrFail($post_id);
        $post->community->user->notify(new PostReportNotification($post));
        return redirect()->back()->with('message','your report has been sent!');
    }
}
