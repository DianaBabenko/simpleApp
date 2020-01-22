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
    @foreach ($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
</table>
@endsection
</body>
</html>
