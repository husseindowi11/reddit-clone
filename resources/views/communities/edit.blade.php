@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light d-flex flex-between-center py-3">
            <h5>
                {{ __('New Community') }}
            </h5>
        </div>
        <form method="POST" action="{{ route('communities.update', $community)}}">
            <div class="card-body">

                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ $community->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description"
                           class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                                <textarea id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description" required>
                                    {{$community->description}}
                                </textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="topics" class="col-md-4 col-form-label text-md-right">{{ __('Topics') }}</label>

                    <div class="col-md-6">
                        <select id="topics" name="topics[]" class="form-control select2" multiple>
                            @foreach($topics as $topic)
                                <option @if($community->topics->contains($topic->id)) selected
                                        @endif value="{{$topic->id}}">
                                    {{$topic->name}}
                                </option>
                            @endforeach
                        </select>


                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light p-4">
                <div class="form-group">
                    <div class="float-right">
                        <button type="submit" class="btn btn-sm btn-success">
                            {{ __('Update Community') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
