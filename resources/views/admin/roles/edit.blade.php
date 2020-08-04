@extends('layouts.management')

@section('content')
    <section class="admin">
        <article class="roles-edit text-center">
            <h1 class="roles-edit__title">Изменить группу</h1>
            <form class="text-center" action="{{ route('admin.roles.update', $data->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="roles-edit__name">Введите новое имя группы: </label>
                    <input class="form-control" type="text" name="name" id="roles-edit__name" value="{{ $data->name }}">
                </div>

                <button class="btn btn-success" type="submit">Изменить группу</button>

                <button class="btn btn-danger" id="roles-edit__delete-btn" type="button"
                        onclick="
                        event.preventDefault();
                        document.querySelector('#roles-edit__delete-form').submit();
                        ">Удалить группу</button>
            </form>

            <form id="roles-edit__delete-form" action="{{ route('admin.roles.destroy', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
            </form>
        </article>
    </section>
@endsection
