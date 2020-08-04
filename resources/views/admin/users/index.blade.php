@extends('layouts.management')

@section('content')
    <section class="admin">
        <article class="users">
            <h1 class="users__title text-center">
                Пользователи
            </h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route('admin.users.edit', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </article>
    </section>
@endsection
