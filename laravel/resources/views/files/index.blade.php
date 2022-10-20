
@extends('layouts.app')
 
 @section('content')

<center>
    <div class="container">
        <div class="row justify-content-center">
    
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Files') }}</div>
                        <div class="card-body">
                        <a  class="btn btn-primary" href="{{url("files/create")}}">Crear file </a></td>
                            <table class="table">
                                <thead>
                                
                                    <tr>
                                        <td scope="col">ID</td>
                                        <td scope="col">Filepath</td>
                                        <td scope="col">Filesize</td>             
                                        <td scope="col">Created</td>
                                        <td scope="col">Updated</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                    <tr>
                                    
                                        <td>{{ $file->id }}</td>
                                        <td>{{ $file->filepath }}</td>
                                        <td>{{ $file->filesize }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>{{ $file->updated_at }}</td>
                                    
                                        <td><a class="btn btn-warning"  href="{{ route("files.edit", $file) }}">edit </a></td>
    
                                        <td> <form action="{{ route('files.destroy',$file) }}" method="POST">   
                                            
                                                @csrf
                                                @method('DELETE')      
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            
                                            </form></td>
                                        
                                        <td>
                                            
                                        </td>
                                        
                                    
                                    </tr>
                                
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<center>
 @include('footer') 
 @endsection
 
 
 
 
 