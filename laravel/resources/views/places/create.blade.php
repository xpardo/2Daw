@extends('layouts.box-app')

@section('box-title')
    {{ __('Add place') }}
@endsection

@section('box-content')
    <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">{{ _('Name') }}</label>
            <input type="text" id="name" name="name" class="form-control" />
        </div>
        <div class="form-group">
            <label for="description">{{ _('Description') }}</label>
            <textarea id="description" name="description" class="form-control"></textarea>
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
        <button type="submit" class="btn btn-primary">{{ _('Create') }}</button>
        <button type="reset" class="btn btn-secondary">{{ _('Reset') }}</button>
    </form>
@endsection