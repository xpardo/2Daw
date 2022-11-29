@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>

                    <a  class="btn btn-primary" href="{{url('files')}}"><u>files</u></a>
                    <p><a  class="btn btn-primary" href="{{url('posts')}}"><u>posts</u></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
