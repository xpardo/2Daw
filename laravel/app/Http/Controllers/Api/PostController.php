<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use App\Models\Post;
use App\Models\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $posts = Post::all();
        return response()->json([
            "success"=> true,
            "data"=>$posts  
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar fitxer
     
        $validatedData = $request->validate([
            'body'          => 'required',
            'upload'        => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'latitude'      => 'required',
            'longitude'     => 'required',
            'visibility_id' => 'required',
        
        ]);
        
        // Obtenir dades del formulari
        $body           = $request->get('body');
        $upload         = $request->file('upload');
        $latitude       = $request->get('latitude');
        $longitude      = $request->get('longitude');
        $visibility_id  = $request->get('visibility_id');
        
        // Desar fitxer al disc i inserir dades a BD
        $file = new File();
        $fileOk = $file->diskSave($upload);

        if ($fileOk) {
            // Desar dades a BD
            \Log::debug("Saving posts at DB...");
            $posts = Post::create([
                'body'          => $body,
                'file_id'       => $file->id,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'author_id'     => auth()->user()->id,
                'visibility_id' => $visibility_id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return response()->json([
                'success' => true,
                'data'    => $posts
            ], 201); 
        } else {
            \Log::debug("Disk storage FAILS");
            // Patró PRG amb missatge d'error
            return response()->json([
                'success'  => false,
                'message' => 'Error storing posts'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      
        $posts=Post::find($id);
        if (empty($posts)) {
            return response()->json([
                'success' => false,
                "message" => "posts ${id} not found"
            ], 404);
        }
        else{
            return response()->json([
                'success' => true,
                'data'    => $posts
            ], 201);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $posts = Post::find($id);
        if(empty($posts)){
            return response()->json([
                "message" => "posts ${id} not found"
            ],404);
        }else{
            $posts->update($request->all());
            return \response($posts);
        }
    }

    public function update_workaround(Request $request, $id) // limitació php
    {
        return $this->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::find($id);
        if (empty($posts)) {
            return \response()->json([
                "message" => "Post ${id} not found"
            ], 404);
        } else {
            Post::destroy($id);
            return \response()->json([
                "message" => "Post ${id} deleted"
            ]);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Likes , Unlike
     */
    public function like($id){
        $user = User::likes($post->author_id);
        $like = Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        if($like){
            return \response()->json([
                "message" => "Post ${id} not found"
            ], 401);
        }
    }
    public function unlike($id){
        $user=User::find($post->author_id);
        $like = Like::where([
            ['user_id', "=" ,$user->id],
            ['post_id', "=" ,$post->id],
        ]);

        $like->first();

        $like->delete();

        if($like){
            return \response()->json([
                "message" => "unlike ${id} not found"
            ], 200);
        }else{
            Post::destroy($id);
            return \response()->json([
                "message" => "Post Unlike ${id} deleted"
            ]);
        }
    
    }
}
