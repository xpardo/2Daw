@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    
                    <br/>
                    
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ $post->body }}
                    </p>
                    

                  
                    <img class="img-fluid" src="{{ asset('/img/post/'.$post->files) }}" title="files preview"/>

                    <hr />
                    
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


                        @if($is_like == false)
                            <form action="{{ route('posts.like',$post) }}" method="post" class="favButton centrar" title="Add to likes">
                                @csrf 
                                <button class="standardButton"><i class="fas fa-thumbs-up"></i></button>
                            </form>
                        @else
                            <form action="{{ route('posts.unlike',$post) }}" method="post" class="favButton centrar" title="Remove from likes">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="standardButton"><i class="fas fa-thumbs-down"></i></button>
                            </form>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection