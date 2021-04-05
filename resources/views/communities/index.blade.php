@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-light d-flex flex-between-center py-3">
            <h5>
                {{ __('My Communities ☎️') }}
            </h5>
        </div>

        <div class="card-body">
            @if(Session('message'))
                <div class="alert alert-info">
                    {{session('message')}}
                </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($communities as $community)
                    <tr class="community-item">
                        <td>
                            <a href="{{route('communities.show', $community)}}">{{$community->name}}</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{route('communities.edit', $community)}}">edit</a>
                            <form method="POST" action="{{route('communities.destroy', $community)}}"
                                  class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="btn btn-sm btn-danger">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <a class="mb-2 btn btn-sm float-right btn-success" href="{{route('communities.create')}}">New Community 🤩</a>
            </div>
        </div>
    </div>

@endsection
