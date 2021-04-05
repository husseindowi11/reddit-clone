<div>
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
                            <p class="mb-1 lh-1"><a class="fw-semi-bold" href="#">{{$post->user->name}}</a></p>
                            <p class="mb-0 fs--1"><span class="far fa-clock"></span>  {{ $post->created_at->diffForHumans() }} •
                                <a class="font-weight-bold" href="{{ route('communities.show', $post->community->slug) }}">{{ $post->community->name }}</a>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="dropdown font-sans-serif">
                        <button class="btn btn-sm dropdown-toggle p-1 dropdown-caret-none" type="button" id="post-article-action" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
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
        <div class="card-body">
            <div>
                <h5 class="fs--1">{{ $post->title }}</h5>
            </div>
        </div>
        <div class="card-footer bg-light pt-2 pb-2 ">
            <div class="row g-0 fw-semi-bold text-center py-1 fs--1">
                @livewire('post-votes', ['post' => $post])
            </div>
        </div>
    </div>
</div>
