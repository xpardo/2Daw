@extends('layouts.app')

@section('content')
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
                    

                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Resources') }}</div>

                <div class="card-body">
               
                        <a href="{{ url('/files') }}">{{ __('Files') }}</a>
                        <p>
                        <a href="{{ url('/posts') }}">{{ __('Post') }}</a>
                        <p>
                        <a href="{{ url('/places') }}">{{ __('Place') }}</a>
                    

                </div>
            </div>
        </div>
    </div>
</div>

                  
@endsection