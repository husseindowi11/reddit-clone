@extends('layouts.app')

@section('content')


    @foreach($posts as $post)
        <div class="row">
            @livewire('post-card',['post' => $post])
        </div>
    @endforeach

@endsection
