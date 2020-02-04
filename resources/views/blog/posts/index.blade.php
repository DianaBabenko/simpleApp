<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<table>
    @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->created_at}}</td>
        </tr>
    @endforeach
</table>
@endsection
</body>
</html>
