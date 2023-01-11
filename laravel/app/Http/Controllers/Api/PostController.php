<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Like;
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
        if (!$posts){
            return response()->json([
                'success' => false,
                'message' => "Post not found"
            ], 404);
        }
        else{
            return response()->json([
                'success' => true,
                'data'    => $posts
            ], 200);
       
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
        if ($posts){
            // Validar dades del formulari
            $validatedData = $request->validate([
                'body'        => 'required|string',
                'upload'      => 'required|mimes:gif,jpeg,jpg,png,mp4|max:2048',
                'latitude'    => 'required',
                'longitude'   => 'required',
                'visibility_id'   => 'required',
            ]);
            
            // Obtenir dades del formulari
            $body        = $request->get('body');
            $upload      = $request->file('upload');
            $latitude    = $request->get('latitude');
            $longitude   = $request->get('longitude');
            $visibility_id  = $request->get('visibility_id');
            

            // Desar fitxer al disc i inserir dades a BD
            $file=File::find($posts->file_id);
            $fileOk = $file->diskSave($upload);

            if ($fileOk) {
                // Desar dades a BD
                $posts-> body = $body;
                $posts-> latitude = $latitude;
                $posts-> longitude = $longitude;
                $posts-> visibility_id = $visibility_id;
                $posts->save();
                // Patró PRG amb missatge d'èxit
                return response()->json([
                    'success' => true,
                    'data'    => $posts
                ], 201); 
            }
            else{
                return response()->json([
                    'success'  => false,
                    'message' => 'Error storing posts'
                ], 500);
            }               
        } else {
            return response()->json([
                'success' => false,
                'message' => "posts not found"
            ], 404);
           
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
        if (!$posts){
            return response()->json([
                'success' => false,
                'message' => "posts not found"
            ], 404);
        }
        else{
            $posts->delete();
            return response()->json([
                'success' => true,
                'data'    => 'File deleted.'
            ], 200);
       
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
     
        $posts = Post::find($id);
        if (like::where([['user_id', "=" ,auth()->user()->id],['post_id', "=" ,$posts->id],])->exists()) {
            return response()->json([
                'success'  => false,
                'message' => 'The post is already like'
            ], 500);
        }else{
            $like = like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $posts->id,
            ]);
            return response()->json([
                'success' => true,
                'data'    => $like
            ], 201);
        }        
    }

    public function unlike($id){
        $posts = Post::find($id);
        if (like::where([['user_id', "=" ,auth()->user()->id],['post_id', "=" ,$posts->id],])->exists()) {
            $like = like::where([
                ['user_id', "=" ,auth()->user()->id],
                ['post_id', "=" ,$posts->id],
            ]);
    
            $like->first();
    
            $like->delete();

            return response()->json([
                'success' => true,
                'data'    => $like
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'The posts is is not like'
            ], 500);
            
        }  
    }
}
