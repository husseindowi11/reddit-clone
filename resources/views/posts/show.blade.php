@extends('layouts.post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <div class="row justify-content-between">
                            <div class="col">
                                <div class="d-flex">
                                    <div class="avatar avatar-2xl">
                                        <img class="rounded-circle" alt=""
                                             src="{{ $post->user->profile_photo_path == null ? "https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" : $profile_photo_path  }}"
                                        >
                                    </div>
                                    <div class="flex-1 align-self-center ms-2">
                                        <p class="mb-1 lh-1">
                                            <a class="fw-semi-bold"
                                               href="#">{{ $post->user->name }}</a> shared a
                                            <a href="#">post</a>
                                        </p>
                                        <p class="mb-0 fs--1">{{ $post->created_at->diffForHumans() }}
                                            <span class="fas fa-globe-americas"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown font-sans-serif">
                                    <button class="btn btn-sm dropdown-toggle p-1 dropdown-caret-none" type="button"
                                            id="post-image-action" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <span class="fas fa-ellipsis-h fs--1"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-3"
                                         aria-labelledby="post-image-action">
                                        @can('edit-post', $post)
                                            <a class="dropdown-item"
                                               href="{{ route('communities.posts.edit', [$post->community, $post]) }}">
                                                Edit
                                            </a>
                                        @endcan
                                        <form method="POST" action="{{route('post.report', $post->id)}}"
                                              class="d-inline-block">
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" type="submit"
                                                    class="dropdown-item">
                                                Report
                                            </button>
                                        </form>

                                        @can('delete-post', $post)
                                            <div class="dropdown-divider"></div>
                                            <form method="POST"
                                                  action="{{route('communities.posts.destroy', [$post->community, $post])}}"
                                                  class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Are you sure?')" type="submit"
                                                        class="dropdown-item text-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-hidden">
                        <h1>{{ $post->title }}</h1>
                        <div>{!! $post->post_text  !!}</div>
                        @if(!empty($post->post_url))
                            <div class="mb-4">
                                <a class="mb-2 " href="{{ $post->post_url }}" target="_blank">{{ $post->post_url }}</a>
                            </div>
                        @endif
                        @if(!empty($post->post_image))
                            <div class="text-center">
                                <a href="{{ asset('storage/' . $post->post_image) }}" data-gallery="gallery-2">
                                    <img class="img-fluid rounded mt-2" src="{{ asset('storage/' . $post->post_image) }}"
                                         alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                @auth
                    @livewire('post-comments',['post' => $post])
                @endauth
            </div>
        </div>
    </div>

    {{--    <div class="card">--}}
    {{--        <div class="card-header">{{ $post->title }}</div>--}}

    {{--        <div class="card-body">--}}
    {{--            @if(session('message'))--}}
    {{--                <div class="alert alert-success">--}}
    {{--                    {{session('message')}}--}}
    {{--                </div>--}}
    {{--            @endif--}}
    {{--            @if(!empty($post->post_url))--}}
    {{--                <div>--}}
    {{--                    <a class="mb-2" href="{{ $post->post_url }}" target="_blank">{{ $post->post_url }}</a>--}}
    {{--                </div>--}}
    {{--            @endif--}}
    {{--            @if(!empty($post->post_image))--}}
    {{--                <img src="{{ asset('storage/' . $post->post_image) }}" alt=""/>--}}
    {{--                <br/> <br/>--}}
    {{--            @endif--}}
    {{--            {{ $post->post_text }}--}}

    {{--            @auth--}}
    {{--                <hr/>--}}
    {{--                @can('edit-post', $post)--}}
    {{--                    <a class="btn btn-sm btn-primary"--}}
    {{--                       href="{{ route('communities.posts.edit', [$post->community, $post]) }}">--}}
    {{--                        Edit--}}
    {{--                        Post--}}
    {{--                    </a>--}}
    {{--                @endcan--}}
    {{--                @can('delete-post', $post)--}}
    {{--                    <form method="POST" action="{{route('communities.posts.destroy', [$post->community, $post])}}"--}}
    {{--                          class="d-inline-block">--}}
    {{--                        @method('DELETE')--}}
    {{--                        @csrf--}}
    {{--                        <button onclick="return confirm('Are you sure?')" type="submit"--}}
    {{--                                class="btn btn-sm btn-danger">--}}
    {{--                            Delete--}}
    {{--                        </button>--}}
    {{--                    </form>--}}
    {{--                @endcan--}}
    {{--                @can('report-post')--}}
    {{--                    <hr/>--}}
    {{--                    <form method="POST" action="{{route('post.report', $post->id)}}"--}}
    {{--                          class="d-inline-block">--}}
    {{--                        @csrf--}}
    {{--                        <button onclick="return confirm('Are you sure?')" type="submit"--}}
    {{--                                class="btn btn-sm btn-danger">--}}
    {{--                            Report post as inappropriate--}}
    {{--                        </button>--}}
    {{--                    </form>--}}
    {{--                @endcan--}}
    {{--                <hr/>--}}
    {{--                <h3>Comments</h3>--}}
    {{--                <hr/>--}}
    {{--                @livewire('post-comments',['post' => $post])--}}
    {{--            @endauth--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection

