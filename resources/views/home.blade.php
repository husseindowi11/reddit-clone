@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Most Popular Posts') }}</div>

        <div class="card-body">
            @foreach($posts as $post)
                <div class="row">
                    <div class="col-1 text-center">
                        <a href="{{ route('post.vote', [$post->id, 1]) }}">
                            <div><i class="fa fa-2x fa-sort-up"></i></div>
                        </a>
                        <h4>{{$post->votes}}</h4>
                        <a href="{{ route('post.vote', [$post->id, -1]) }}">
                            <div><i class="fa fa-2x fa-sort-down"></i></div>
                        </a>
                    </div>
                    <div class="col-11">
                        {{ $post->votes_count }} positive votes
                        <a href="{{ route('communities.posts.show',[$post->community, $post]) }}">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                        <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

@endsection
