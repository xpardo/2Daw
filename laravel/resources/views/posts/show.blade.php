@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                    <tr>
                        <td><strong>ID<strong></td>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Body</strong></td>
                        <td>{{ $post->body }}</td>
                    </tr>

                    <tr>
                        <td><strong>Lat</strong></td>
                        <td>{{ $post->latitude }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lng</strong></td>
                        <td>{{ $post->longitude }}</td>
                    </tr>
                    

                  
                    <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview"/>

                    <tr>
                        <td><strong>Author</strong></td>
                        <td>{{ $author->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Created</strong></td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated</strong></td>
                        <td>{{ $post->updated_at }}</td>
                    </tr>
                 
                    
                    <h4>Display Comments</h4>
  
                    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
   
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ url('comment') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection