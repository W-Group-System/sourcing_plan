@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Assign Modules to {{ $user->name }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('users.permissions.update', $user->id) }}">
        @csrf

        @foreach($permissions as $permission)
            <div class="form-check">
                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                       class="form-check-input"
                       {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                <label class="form-check-label">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Save Permissions</button>
    </form>
</div>
@endsection
