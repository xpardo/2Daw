@extends('layouts.app')
@section('content')
    @include('flash')

    @yield('resources/js/files/create.js')


<script src="js/files/create.js"></script>
<script>
  Validator.useLang('es');
</script>

    <div class="col-lg-12 margin-tb">
        <center>
            <h2>New Files</h2>
        </center>
    </div>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Create Files') }}</div>
                    <div class="card-body">
                        

                        <form id="file" action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="form-group">
                                    <label for="upload">{{__('FILE')}}</label>
                                    <input type="file" id="file" name="upload" class="form-control @error('file') is-invalid @enderror"  value="{{ old('file') }}"/>
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                    <a class="btn btn-primary" href="{{ route('files.index') }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 
@endsection




 