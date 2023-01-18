
@extends('layouts.app')
 
 @section('content')

<center>
    <div class="container">
        <div class="row justify-content-center">
       
            <div class="col-md-8">
                <br>
                <div class="card">
                    <div class="card-header">{{ __('Files') }}</div>
                        <div class="card-body">
                        <b><a class="btn btn-primary" href="{{ route('files.create') }}" role="button">➕ Add new file</a></b>
                            <table class="table">
                                <thead>
                                
                                    <tr>
                                        <td scope="col">ID</td>
                                        <td scope="col">Filepath</td>
                                        <td scope="col">Filesize</td>             
                                        <td scope="col">Created</td>
                                        <td scope="col">Updated</td>
                                        <td scope="col">Show</td>
                                        <td scope="col">Edit</td>
                                        <td scope="col">Delete</td>
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
                                    
                                        <td><a title="View" href="{{ route('files.show', $file) }}">👁️</a></td>
                                        <td><a title="Edit" href="{{ route('files.edit', $file) }}">📝</a></td>
                                        <td><a title="Delete" href="{{ route('files.show', [$file, 'delete' => 1]) }}">🗑️</a></td>

                                  
                                    
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

 @endsection
 

 
 
 