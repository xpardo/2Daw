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
                    
                   
   
                    <hr />
                  

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