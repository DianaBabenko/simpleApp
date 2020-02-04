@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\BlogPost $post */ @endphp
    <div class="container">

        @include('blog.admin.posts.includes.result_messages')

        @if($post->exists)
        <form method="POST" action="{{ route('blog.admin.posts.update', $post->id) }}">
            @method('PATCH')

            @else
                <form method="POST" action="{{ route('blog.admin.posts.store') }}">
                    @endif

                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @include('blog.admin.posts.includes.post_edit_main_col')
                        </div>
                        <div class="col-md-3">
                            @include('blog.admin.posts.includes.post_edit_add_col')
                        </div>
                    </div>
                </form>
        </form>

        @if($post->exists)
        <br>
            <form method="POST" action="{{ route('blog.admin.posts.destroy', $post->id) }}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-block">
                            <div class="card-body ml-auto">
                                <button type="submit" class="btn btn-link">Удалить</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
        @endif

    </div>

@endsection
