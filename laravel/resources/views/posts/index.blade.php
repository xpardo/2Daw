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
                    <th scope="col">body</th>
                    <th scope="col">nom de la imatge</th>
                    <th scope="col">imatge</th>
                    <th scope="col">like</th>
                    <th scope="col" width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->nombre }}</td>
                    <td>

                    <img class="img-fluid" src="{{ asset('/img/post/'.$post->imagen) }}" title="Image preview"/>


                    </td>
                    
                    <td>
                
                        <form action="{{ route('like.post', $post->id) }}"method="post">
                            @csrf
                            <button
                                class="{{ $post->liked ? '' : '' }} ">
                                <i class="fas fa-thumbs-up"></i> {{ $post->likeCount }}
                            </button>
                        </form>
                    </td>
                  
                    <td>
                    
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary"> <i class="fas fad fa-eye"></i></a>
                        <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method("DELETE")
                            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️</button>
                        </form>
                        @include('posts/modal')  
                    </td>
                </tr>
                @endforeach
                </tbody>
   
            </table>
        </div>
    </div>
</div>
@endsection    