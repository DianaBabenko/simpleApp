@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('blog.admin.posts.includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Категория</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $category)
                                @php /** @var \App\Models\BlogCategory $category */ @endphp
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.categories.edit', $category->id) }}">
                                            {{ $category->title }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </div>
@endsection
