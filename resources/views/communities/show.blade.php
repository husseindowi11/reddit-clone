@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h1>
                        {{ $community->name }}
                    </h1>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('communities.show', $community) }}"
                       @if(request('sort', '') == '') style="font-size: 18px" @endif>Newest Posts</a>
                    <br/>
                    <a href="{{ route('communities.show', $community) }}?sort=popular"
                       @if(request('sort', '') == 'popular') style="font-size: 18px" @endif>Popular Posts</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('communities.posts.create', $community) }}">Add Post</a>
            <br/> <br/>
            @forelse($posts as $post)

                <div class="row">
                    @livewire('post-votes', ['post' => $post])
                    <div class="col-11">
                        <a href="{{ route('communities.posts.show',[$community, $post]) }}">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                        <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                    </div>
                </div>
                <hr>
            @empty
                <h3>No posts found...</h3>
            @endforelse
            {{ $posts->links() }}
        </div>
    </div>

@endsection
