<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public $post;
    public $comment_text;
    public $comment_text_update;


    protected $rules = [
        'comment_text' => 'required',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function resetValues()
    {
        $this->reset(['comment_text_update','comment_text']);
    }




    public function storeComment()
    {
        $this->validate();
        Comment::create([
            'comment_text' => $this->comment_text,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id
        ]);
        $this->post->load('comments.user');
        $this->resetValues();
    }

    public function updateComment(Comment $comment)
    {
        $comment->update([
            'comment_text' => $this->comment_text_update,
        ]);
        $this->post->load('comments.user');
        $this->resetValues();
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        $this->post->load('comments.user');
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
