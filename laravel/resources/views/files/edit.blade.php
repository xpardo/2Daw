@extends('layouts.app')
  
@section('content')

<center>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Files</h2>
        </div>
    </div>
</center>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
                    <div class="card-header">{{ __(' Edit Files') }}</div>
                </center>
                    <div class="card-body">
                        <form action="{{ route('files.update', $file) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="upload">File:</label>
                                    <input type="file" class="form-control" name="upload"/>
                                </div>
                                <a class="btn btn-primary" href="{{ route('files.index') }}">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection