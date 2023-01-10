<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use App\Models\Post;
use App\Models\Like;
use App\Models\Visibility;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("posts.create", [
            "visibilities" => Visibility::all()
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
        
        // Validar dades del formulari
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
            Log::debug("Saving post at DB...");
            $post = Post::create([
                'body'          => $body,
                'file_id'       => $file->id,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'author_id'     => auth()->user()->id,
                'visibility_id' => $visibility_id,
            ]);
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('posts.show', $posts)
                ->with('success', __('posts successfully saved'));
        } else {
            \Log::debug("Disk storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.create")
                ->with('error', __('ERROR Uploading file'));
        }
    
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


        $file=File::find($post->file_id);
        $user=User::find($post->author_id);

        $is_like = false;
        try {
            if (Like::where('user_id', '=', auth()->user()->id)->where('post_id','=', $post->id)->exists()) {
                $is_like = true;
            }
        } catch (Exception $error) {
            $is_like = false;
        }
    
        return view("posts.show",[
            'post'=> $post,
            'file'=>$file,
            'user'=>$user,
            'is_like'=>$is_like,
        ]);        
         
         
    }
    /**
     * EDIT
     */


    public function edit(Post $post)
    {
        // Comprovar si l'usuari/a pot editar (PostPolicy)
        $this->authorize('update', $post);

        return view("posts.edit", [
            'post'   => $post,
            'file'   => $post->file,
            'author' => $post->user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Comprovar si l'usuari/a pot editar (PostPolicy)
        $this->authorize('update', $post);

        // Validar dades del formulari
        $validatedData = $request->validate([
            'body'       => 'required',
            'upload'     => 'nullable|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            'latitude'   => 'required',
            'longitude'  => 'required',
            'visibility' => 'required|exists:visibilities,id',
        ]);

        // Obtenir dades del formulari
        $body      = $request->get('body');
        $upload    = $request->file('upload');
        $latitude  = $request->get('latitude');
        $longitude = $request->get('longitude');
        $visibility  = $request->get('visibility');

        // Desar fitxer (opcional)
        if (is_null($upload) || $post->file->diskSave($upload)) {
            // Actualitzar dades a BD
            Log::debug("Updating DB...");
            $post->body           = $body;
            $post->latitude       = $latitude;
            $post->longitude      = $longitude;
            $post->visibility_id = $visibility;
            $post->save();
            Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('posts.show', $post)
                ->with('success', __(':resource successfully updated', [
                    'resource' => __('resources.post')
                ]));
        } else {
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.edit")
                ->with('error', __('ERROR Uploading file'));
        }
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



    /**
    * Likes
    */

    public function likes(post $post)
    {
        $user = User::likes($post->author_id);
        $like = Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        return redirect()->route('posts.index')->with('message','Post Like successfully!');
    }

    public function unlike(Post $posts)
    {
        $user=User::find($post->author_id);
        $like = Like::where([
            ['user_id', "=" ,$user->id],
            ['post_id', "=" ,$post->id],
        ]);

        $like->first();

        $like->delete();

        return redirect()->back();
    }

}
