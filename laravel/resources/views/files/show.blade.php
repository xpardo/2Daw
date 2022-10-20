@extends('layouts.app')
  
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Create Files') }}</div>
                    <div class="card-body">
                        <div class="row">
                           
                        </div>
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>created_at:</strong>
                                    {{ $file->created_at }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>updated_at:</strong>
                                    {{ $file->updated_at }}
                                </div>
                            </div>

                            <div class="col-lg-12 margin-tb">
                                
                            </div>
                                <form action="{{ route('files.destroy',$file) }}" method="POST">   
                                                        
                                    @csrf
                                  
                                    <a class="btn btn-warning"  href="{{ route("files.edit", $file) }}">edit </a>
                                    <a class="btn btn-primary" href="{{ route('files.index') }}">Back</a>
                                    
                                    @method('DELETE')      
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                          
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('footer') 
@endsection