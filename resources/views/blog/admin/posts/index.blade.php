@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Написать</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Автор</th>
                                <th>Категория</th>
                                <th>Дата публикации</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginatorPosts as $post)
                                @php /** @var \App\Models\BlogPost $post */ @endphp
                                <tr @if($post->is_published === false) style="background-color: lightsteelblue;" @endif>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>{{ $post->category->title }}</td>
                                    <td> {{ optional($post->published_at)->format('d.M H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginatorPosts->total() > $paginatorPosts->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginatorPosts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
