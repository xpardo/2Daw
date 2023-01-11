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
                        
                       
                    </form>

                     <!-- Buttons -->
                    <div class="container" style="margin-bottom:20px">
                        <a class="btn btn-warning" href="{{ route('posts.edit', $post) }}" role="button">📝 {{ __('actions.edit') }}</a>
                        <form id="form" method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline-block;">
                            @csrf
                            @method("DELETE")
                            <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ {{ __('actions.delete') }}</button>
                        </form>
                        <a class="btn" href="{{ route('posts.index') }}" role="button">⬅️ {{ __('actions.back') }}</a>
                    </div>

                    <!-- Likes buttons -->
                    <div class="container" style="margin-bottom:20px">
                        <p>{{ __(':number likes', ['number' => $numLikes]) }}</p>
                        @include('partials.buttons-likes')
                    </div>

                    <!-- Modal -->
                    @include('partials.delete-modal', [
                        'resource' => __('resources.post'), 
                        'id'       => $post->id
                    ])

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection