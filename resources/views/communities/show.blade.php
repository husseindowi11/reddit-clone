@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header position-relative min-vh-50 mb-2">
            <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url({{ $community->image == null ? "../assets/img/generic/4.jpg" : $community->image }});">
            </div>
            <!--/.bg-holder-->
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col">
                            <h4 class="mb-1"> {{ $community->name }}
                                {{--                        <span data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Verified" aria-label="Verified">--}}
                                {{--                            <small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small>--}}
                                {{--                        </span>--}}
                            </h4>
                        </div>
                        <div class="col">
                            <a class="float-right btn btn-sm btn-primary rounded-pill me-1 mb-1" href="{{route('communities.posts.create', $community)}}">
                                <span class="fas fa-pen"></span> Add Post
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h5>Filter: </h5>
                        @livewire('filter-card', ['community' => $community])
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div>
        @forelse($posts as $post)
            @livewire('post-card',['post' => $post])
        @empty
            <h3>No posts found...</h3>
        @endforelse
        {{ $posts->links() }}
    </div>

@endsection
