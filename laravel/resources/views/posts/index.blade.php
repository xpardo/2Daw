@extends('layouts.app')
@section('box-title')
    {{ __('Files') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Totes les publicacions</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right">Crea una publicació</a>
            <table class="table table-bordered">
                <thead>
                    <th width="80px" scope="col">Id</th>
                    <th scope="col">body</th>
                    <th scope="col">files</th>
                    <th scope="col">Lat</th>
                    <th scope="col">Long</th>
                    <th scope="col">like</th>
                    <th scope="col" width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ substr($post->body,0,10) . "..." }}</td>
                    <td>{{ $post->file_id }}</td>
                    <td>{{ $post->latitude }}</td>
                    <td>{{ $post->longitude }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    
                 
                  
                    <td>
                    
                        <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method("DELETE")
                            <a title="{{ _('Edit') }}" href="{{ route('posts.edit', $post) }}">📝</a>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary"> <i class="fas fad fa-eye"></i></a>

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