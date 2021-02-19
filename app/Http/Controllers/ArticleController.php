<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::latest()->get();
        // return $articles;
        return view('articles.index',[
            'articles' => $articles
        ]);
    }

    public function show(Article $article){
        // return $article;
        return view('articles.show',[
            'article' => $article
        ]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(){

        $this->validateArticle();
        if(request()->hasfile('filenames'))
         {
            foreach(request()->file('filenames') as $file)
            {
                $name = $file->getclientOriginalName();
                $file->move(public_path().'/files/', $name);
                $data[] = $name; 
            }
         }
        $article = Article::create([
            'user_id' => Auth::user()->id,
            'title' => request()->title,
            'excerpt' => request()->excerpt,
            'body' => request()->body,
            'filenames' => json_encode($data),
        ]);

        foreach (request()->tags as $tag) {
            if($tag)
            {
                $newtag = Tag::firstOrCreate([
                    'name' => $tag,
                  ]);

                $article->tags()->attach($newtag->id);
            }        
        }
        
        return redirect('/');
    }

    public function edit(Article $article){

    }

    public function update(){
        
    }

    public function validateArticle(){
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'filenames' => 'required',
            'filenames.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'    => 'required|array|min:1',
            'tags.*'    => 'required|distinct|min:1',
        ],
        [
            'title.required' => 'The title is required.',
            'excerpt.required' => 'The excerpt is required.',
            'body.required' => 'The body is required.',
            'tags.*.required' => 'The tag is required.',
            'tags.*.distinct' => 'The tags must be distinct.',
            'filenames.required' => 'The photo is required.',
        ]);
    }

}
