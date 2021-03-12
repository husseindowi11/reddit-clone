@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ $post->title }}</div>

        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            @if(!empty($post->post_url))
                <div>
                    <a class="mb-2" href="{{ $post->post_url }}" target="_blank">{{ $post->post_url }}</a>
                </div>
            @endif
            @if(!empty($post->post_image))
                <img src="{{ asset('storage/' . $post->post_image) }}" alt=""/>
                <br/> <br/>
            @endif
            {{ $post->post_text }}

            @auth
                <hr/>
                <h3>Comments</h3>
                <hr/>
                @forelse($post->comments as $comment)
                    <b>{{ $comment->user->name }}</b>
                    <br/>
                    {{ $comment->created_at->diffForHumans() }}
                    <p class="mt-2 mb-0"> {{ $comment->comment_text }}</p>
                @empty
                    No Comments yet...
                @endforelse
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf

                    <br/>
                    <label for="comment_text">Add a comment:</label>
                    <textarea id="comment_text" rows="5" name="comment_text"
                              class="form-control @error('comment_text') is-invalid @enderror"></textarea>
                    @error('comment_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    <br/>
                    <button type="submit" class="btn btn-sm btn-primary">Add Comment</button>
                </form>
                @can('edit-post', $post)
                    <hr/>
                    <a class="btn btn-sm btn-primary"
                       href="{{ route('communities.posts.edit', [$post->community, $post]) }}">Edit
                        Post
                    </a>
                @endcan
                @can('delete-post', $post)
                    <form method="POST" action="{{route('communities.posts.destroy', [$post->community, $post])}}"
                          class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Are you sure?')" type="submit"
                                class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                @else
                    <hr/>
                    <form method="POST" action="{{route('post.report', $post->id)}}"
                          class="d-inline-block">
                        @csrf
                        <button onclick="return confirm('Are you sure?')" type="submit"
                                class="btn btn-sm btn-danger">
                            Report post as inappropriate
                        </button>
                    </form>
                @endcan
            @endauth
        </div>
    </div>
@endsection
