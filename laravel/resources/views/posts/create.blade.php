@extends('layouts.app')
   
@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@yield('resources/js/posts/create.js')
<script src="js/posts/create.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear publicació</div>
                <div class="card-body">

                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                     
                         
                    <div class="form-group">
                        <label for="body">{{ _('Body') }}</label>
                        <textarea id="body" name="body" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="upload">{{ _('File') }}</label>
                        <input type="file" id="upload" name="upload" class="form-control" />
                    </div>
                    <div class="form-group">            
                            <label for="latitude">{{ _('Latitude') }}</label>
                            <input type="text" id="latitude" name="latitude" class="form-control"
                                value="41.2310371"/>
                    </div>
                    <div class="form-group">            
                        <label for="longitude">{{ _('Longitude') }}</label>
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
    
@endsection

