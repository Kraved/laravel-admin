@extends('layouts.management')

@section('content')
    <section class="admin">
        <article class="roles-edit text-center">
            <h1 class="roles-edit__title">Добавить новую группу</h1>
            <form class="text-center" action="{{ route('admin.roles.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="roles-edit__name">Введите имя группы: </label>
                    <input class="form-control" type="text" name="name" id="roles-edit__name">
                </div>

                <button class="btn btn-primary" type="submit">Добавить группу</button>
            </form>
        </article>
    </section>
@endsection
