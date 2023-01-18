@extends('layouts.app')
   
@section('content')

@section('box-title')
    {{ __('actions.add') . " " . __('resources.post') }}
@endsection


@yield('resources/js/posts/create.js')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear publicació</div>
                    <div class="card-body">

                    
                        <form id="posts" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        
                                
                            <div class="form-group">
                                <label for="body">{{ __('fields.body') }}</label>
                                <textarea id="body" name="body" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="upload">{{ __('fields.file') }}</label>
                                <input type="file" id="upload" name="upload" class="form-control" />
                            </div>
                            <div class="form-group">            
                                    <label for="latitude">{{ __('fields.latitude') }}</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        value="41.2310371"/>
                            </div>
                            <div class="form-group">            
                                <label for="longitude">{{ __('fields.longitude') }}</label>
                                <input type="text" id="longitude" name="longitude" class="form-control"
                                        value="1.7282036"/>
                            </div>
                            <div class="form-group">
                                <label for="visibility">{{ __('fields.visibility') }}</label>
                                <select id="visibility" name="visibility" class="form-control">
                                    @foreach(App\Models\Visibility::all() as $visibility)
                                    <option value="{{ $visibility->id }}">
                                        {{ __($visibility->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ _('Create') }}</button>
                                    <a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
                                </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
    
@endsection
