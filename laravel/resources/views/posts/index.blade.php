@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Gestion publicacions</h1>

            <b><a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">➕ Crear publicacio</a></b>

            <table class="table table-bordered">
                <thead>
                    <th width="80px">Id</th>
                    <th scope="col">Titól</th>
                    <th scope="col">Filepath</td> 
                    <th width="150px">Action</th>
                    
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->filepath }}</td>
             
                    
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">👁️</a>
                        <form id="form" method="POST" action="{{ route('files.destroy', $file) }}">
                            @csrf
                            @method("DELETE")
                            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ Delete</button>
                        </form>
                        @include('modal')
                    </td>
                </tr>
                @endforeach
                </tbody>
   
            </table>
        </div>
    </div>
</div>
@endsection  