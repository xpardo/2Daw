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
                    <th scope="col">Filepath</th>
                    <th scope="col">Filesize</th>
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
                        <form action="{{ route('like.post', $post->id) }}"
                            method="post">
                            @csrf
                            <button
                                class="{{ $post->liked() ?  : '' }} ">
                                like {{ $post->likeCount }}
                            </button>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('unlike.post', $post->id) }}"
                            method="post">
                            @csrf
                            <button
                                class="{{ $post->liked() ? 'block' : 'hidden'  }}">
                                unlike
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">veure publicació</a>
                        <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}">
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