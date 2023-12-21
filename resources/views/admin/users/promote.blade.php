@extends('layouts.app')

@section('content')
    <h1>Promote User as Admin</h1>

    <p>Are you sure you want to promote the user "{{ $user->name }}" to an admin?</p>

    <form method="POST" action="{{ route('admin.users.promote', $user) }}">
        @csrf

        <button type="submit">Promote</button>
    </form>
@endsection
