@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Post</div>
                <div class="card-body">
                <form action="route('posts.store') }}" method="POST" enctype="multipart/form-data">

                     @csrf
                        <div class="form-group">
                            
                            <label class="label">Titól: </label>
                            <input type="text" name="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Cos del missatge: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="upload">Imatge:</label>
                            <input type="file" class="form-control" name="upload"/>
                        </div>
                        <div class="form-group">
                   
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">Tornar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  