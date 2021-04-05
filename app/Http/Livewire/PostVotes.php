<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PostVotes extends Component
{
    public $post;
    public $sumVotes;
    public function mount($post)
    {
        $this->post = $post;
        $this->sumVotes = $post->postVotes->sum('vote');
    }

    public function vote($vote)
    {
        if (auth()->check() == false)
        {
            return redirect()->route('login');
        }

        if ( !$this->post->postVotes->where('user_id',auth()->id())->count()
        and in_array($vote,[-1,1]) and $this->post->user_id != auth()->id())
        {
            $postVote = PostVote::create([
                'post_id' => $this->post->id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);
            $this->sumVotes = PostVote::where('post_id', $this->post->id)->get()->sum('vote');
        }
        if ($this->post->postVotes->where('user_id',auth()->id())->count()
            and in_array($vote,[-1,1]) and $this->post->user_id != auth()->id())
        {
            $postVote = PostVote::where('user_id', auth()->id())->where('post_id', $this->post->id)->get()->first();
            $postVote->vote = $vote;
            $postVote->save();
            $this->sumVotes = PostVote::where('post_id', $this->post->id)->get()->sum('vote') ;
        }

    }
    public function render()
    {
        return view('livewire.post-votes');
    }
}
