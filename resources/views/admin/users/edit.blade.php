@extends('layouts.management')

@section('content')
    <section class="admin">
        <article class="users-edit text-center">
            <h1 class="users-edit__title">Изменить пользователя</h1>
            <form class="text-center" action="{{ route('admin.users.update', $data['user'] ->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="user-edit__name">Введите новое имя пользователя: </label>
                    <input class="form-control" type="text" name="name" id="user-edit__name" value="{{ $data['user'] ->name }}">
                </div>

                <div class="form-group">
                    <label for="user-edit__email">Введите новую почту:  </label>
                    <input class="form-control" type="text" name="email" id="user-edit__email" value="{{ $data['user'] ->email }}">
                </div>

                <div class="form-group text-center user-group-panel" id="user-group-panel">
                    <label>Группы пользователя:  </label>
                    @foreach ($data['user']->roles as $role)
                        <div class="user-group-panel__item">
                            <input class="form-control" type="text" name="roles[]" value="{{ $role->name }}" readonly>
                            <div class="button-close" type="button">&times;</div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group text-left user-edit__add-group">
                    <div class="dropdown open">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId"
                                data-toggle="dropdown"
                                >
                            Добавить группу
                        </button>
                        <div class="dropdown-menu" id="user-add-group-menu">
                            @foreach($data['roles'] as $role)
                                <button class="dropdown-item" type="button" value="{{ $role->name }}">{{ $role->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <input type="hidden" name="userName" value="{{ $data['user']->name }}">

                <button class="btn btn-success" type="submit">Изменить пользователя</button>

                <button class="btn btn-danger" id="user-edit__delete-btn" type="button"
                        onclick="
                        event.preventDefault();
                        document.querySelector('#user-edit__delete-form').submit();
                        ">Удалить пользователя</button>
            </form>

            <form id="user-edit__delete-form" action="{{ route('admin.users.destroy', $data['user'] ->id) }}" method="post">
                @csrf
                @method('DELETE')
            </form>
        </article>
    </section>
@endsection
