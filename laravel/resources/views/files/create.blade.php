@extends('layouts.app')
  
@section('content')

<center>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>New Files</h2>
        </div>
    </div>
</center>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Create Files') }}</div>
                    <div class="card-body">
                        

                        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="upload">File:</label>
                                        <input type="file" name="upload" class="form-control" placeholder="Enter filepath">
                                    </div>
                                </div>
                                <br>    <br>    <br>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="created_at">created_at:</label>
                                        <input type="date"  class="form-control"  id="data" name="data"><br><br>
                                    </div>
                                </div>
                            
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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

@include('footer') 
 
@endsection


 