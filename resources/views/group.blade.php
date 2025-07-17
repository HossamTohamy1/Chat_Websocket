@extends('layout.app')

@section('title', 'Group Page')

@section('content')
    <div class="container mt-4">
        <h2>Group Page</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('group.create') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="group_name" class="form-control" placeholder="Enter group name" required>
                <button class="btn btn-primary" type="submit">Create Group</button>
            </div>
        </form>

        <h4>Groups:</h4>
        @if (count($groups) > 0)
            <ul class="list-group">
                @foreach ($groups as $group)
                    <li class="list-group-item">{{ $group }}</li>
                @endforeach
            </ul>
        @else
            <p>No groups yet.</p>
        @endif
    </div>
@endsection
