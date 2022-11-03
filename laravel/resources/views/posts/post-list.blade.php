@extends('layouts.app')
   
   @section('content')
    <div class="py-12">

            <h4 >Post </h4>
            @if (session()->has('message'))
            <div>
                {{ session('message') }}
            </div>
            @endif
    
        <div class="py-2">
            
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            img
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td >

                                {{ $post->id }}

                            </td>
                            <td >
                                
                                {{ $post->title }}
 
                            </td>

                            <td>
                                {{ $post->description }}
                            </td>
                            <td >
                                <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview"/>

                            </td>

                            <td>
                                <form action="{{ route('like.post', $post->id) }}" method="post">
                                    @csrf
                                    <button class="{{ $post->liked() ?  }}"> like {{ $post->likeCount }}
                                    </button>
                                </form>

                            </td>
                            <td>
                                <form action="{{ route('unlike.post', $post->id) }}"
                                    method="post">
                                    @csrf
                                    <button
                                        class="{{ $post->liked() ? 'block' : 'hidden'  }}">
                                        unlike
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>       
        </div>
    </div>
@endsection  