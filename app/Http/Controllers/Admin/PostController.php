<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Post;   //importo il modello
use App\Category;   //importo il modello
use App\Tag;    //importo il modello
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();   //recupero tutte le righe(tuple,record) della tabella posts
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //effettuo il controllo e la validazione dei dati immessi dall'utente e conservati in $request
        //questi controlli devono rispecchiare le condizioni imposte nella migration per la creazione della relativa tabella
        $request->validate([
            'title'=>'required|max:250',
            'content'=>'required|min:5|max:100',
            'category_id'=>'required|exists:categories,id',//mi assicuro che  il valore presente in 'category_id' o è nullo oppure se è valorizzato esista nella tabella
            'tags[]'=>'exists:tags,id'
        ],
    [//personalizzo i messaggi di errore
        'title.required' =>'Il titolo deve essere valorizzato',
        'title.max'=>'Hai superato i :attribute caratteri',
        'content.required'=>':attribute deve essere compilato',
        'content.min'=>'Il contenuto deve avere almeno :min caratteri',
        'content.max'=>'Il contenuto deve avere al massimo :max caratteri',
        'category_id.exists'=>'La categoria selezionata non esiste',
        'tags[]'=>'Tag non esiste'
    ]);
        $postData = $request->all();
        $newPost = new Post();
        $newPost->fill($postData);
        $slug = Str::slug($newPost->title);
        $alternativeSlug = $slug;
        $postFound = Post::where('slug',$alternativeSlug)->first();
        $counter = 1;
        while($postFound)
        {
            $alternativeSlug = $slug . '_' . $counter;
            $counter++;
            $postFound = Post::where('slug',$alternativeSlug)->first();
        }
        $newPost->slug = $alternativeSlug;
        $newPost->save();

        $newPost->tags()->sync($postData['tags']);
        return redirect()->route('admin.posts.index');
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
        $post = Post::find($id);  // $post = Post::findOrFail($id);
        if(!$post)
        {
            abort(404);
        }

        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);  // $post = Post::findOrFail($id);
        if(!$post)
        {
            abort(404);
        }

        $categories = Category::all();
        return view('admin.posts.edit',compact('post','categories'));
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
        //
        $post = Post::findOrFail($id);  // $post = Post::find($id);
        $request->validate([
            'title'=>'required|max:250',
            'content'=>'required',
            'category_id'=>'required|exist:categories,id'
        ],
         [//personalizzo i messaggi di errore
            'title.required' =>'Il titolo deve essere valorizzato',
            'title.max'=>'Hai superato i :attribute caratteri',
            'content.required'=>':attribute deve essere compilato',
            'content.min'=>'Il contenuto deve avere almeno .min caratteri',
            'content.max'=>'Il contenuto deve avere al massimo :max caratteri',
            'category_id.exist'=>'La categoria selezionata non esiste'
        ]);

        $postData = $request->all();
        $post->fill($postData);

        $slug = Str::slug($post->title);
        $alternativeSlug = $slug;
        $postFound = Post::where('slug',$alternativeSlug)->first();
        $counter = 1;
        while($postFound)
        {
            $alternativeSlug = $slug . '_' . $counter;
            $counter++;
            $postFound = Post::where('slug',$alternativeSlug)->first();
        }
        $post->slug = $alternativeSlug;

        $post->update();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        /* $post = Post::find($id);
           if(!$post)
          {
            abort(404);
          }
        */
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
