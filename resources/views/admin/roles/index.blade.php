@extends('layouts.management')

@section('content')
    <section class="admin">
        <article class="roles">
            <h1 class="roles__title text-center">
                Группы
            </h1>
            <div class="admin-create-btn">
                <a class="btn btn-primary text-left" href="{{ route('admin.roles.create') }}">Добавить группу</a>
            </div>
            <table class="table table-bordered">
            	<thead>
            		<tr>
            			<th>ID</th>
            			<th>Имя группы</th>
            		</tr>
            	</thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ route('admin.roles.edit', $item->id) }}">{{ $item->name }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </section>
@endsection
