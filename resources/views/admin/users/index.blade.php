<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>User List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}">Edit</a>
                        <a href="{{ route('admin.users.delete', $user) }}">Delete</a>
                        <a href="{{ route('admin.users.promote', $user) }}">Promote</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
