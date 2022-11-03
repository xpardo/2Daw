@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Las meves publicacions</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right">Crea una publicació</a>
            <table class="table table-bordered">
                <thead>
                    <th width="80px" scope="col">Id</th>
                    <th scope="col">Titól</th>
                    <td scope="col">Filepath</td>
                    <td scope="col">Filesize</td>
                    <th scope="col" width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->Filepath }}</td>
                    <td>{{ $post->Filesize }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">veure publicació</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
   
            </table>
        </div>
    </div>
</div>
@endsection    