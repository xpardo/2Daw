@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear publicació</div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            @csrf
                            <label class="label">Titól: </label>
                            <input type="text" name="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Cos del missatge: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="upload">File:</label>
                            <input type="file" name="files">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection