@extends('layouts.post')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold">{{ __('Edit Post')}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('communities.posts.update', [$community, $post]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-left">{{ __('Title') }}*</label>

                        <div class="col-md-12">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ $post->title }}" required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="post_text" class="col-md-4 col-form-label text-md-left">{{ __('Post Text') }}</label>

                        <div class="col-md-12">
                            <textarea id="post_text"
                                      name="post_text"
                                      class="tinymce d-none @error('post_text') is-invalid @enderror"
                                      autocomplete="post_text">
                                    {{ $post->post_text }}
                                </textarea>

                            @error('post_text')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="post_image" class="col-md-4 col-form-label text-md-left">{{ __('Post Image') }}</label>

                        <div class="col-md-12">
                            <input type="file" name="post_image"/>
                            @error('post_image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Post') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
