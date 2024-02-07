@extends('Admin.layouts.admin')
@section('content')
    <h2>Team Members</h2>


    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.teams.create') }}" class="btn btn-success mb-3">Add Team Member</a>





{{--    <div>--}}
{{--        @foreach(config('app.languages') as $lang)--}}
{{--            <a href="{{ route('admin.teams.index', ['lang' => $lang]) }}">--}}
{{--                <span>{{ $lang }}</span>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--    </div>--}}

    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Lang</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
{{--            @dd($team)--}}
            <tr>
                <td>{{ $team->id }}</td>
                <td><img src="{{ asset('storage/'. $team->image) }}" alt="Team Member Image" width="100"></td>
                <td>{{ $team->title  }}</td>
                @foreach($team->translations as $teamTranslation)
                    <td>{{ $teamTranslation->position}}</td>
                @endforeach
                <td>
                    <a href="{{ route('admin.teams.edit', ['team' => $team->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.teams.destroy', ['team' => $team->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
