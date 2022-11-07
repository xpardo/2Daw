<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use App\Models\Post;


class PostController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("posts.index",[
            "posts" => Post::all()
        ]); 
    }


    public function likePost($id)
    {
        $post = Post::find($id);
        $post->like;
        $post->save();

        return redirect()->route('posts.index')->with('message','Post Like successfully!');
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;


        if($request->hasFile("files")){

            $files = $request->file("files");
            $nombreimagen = Str::slug($request->nombre).".".$files->guessExtension();
            $ruta = public_path("img/post/");

            //$imagen->move($ruta,$nombreimagen);
            copy($files->getRealPath(),$ruta.$nombreimagen);

            $post->files = $nombreimagen;            
            
        }
     
        $post->save();
      
        return redirect()->route('posts.show', $post)
            ->with('success', 'File successfully saved');
    
    }
    
   
 /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //

        return view('posts.show',compact('post'));
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       
        $post->delete();
        return redirect('posts')
            ->with('success', "el post sa elminatat correctament.");
    }
}
