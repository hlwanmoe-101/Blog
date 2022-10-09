<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(){

//        $article=Article::all();
//        foreach ($article as $a){
//            $a->excerpt=Str::words($a->description,50);
//            $a->update();
//        }
        $articles=Article::when(isset(request()->search),function($q){
            $search=request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest('id')->paginate(6);
        return view('welcome',compact('articles'));
    }

    public function detail($slug){
        $article=Article::where('slug',$slug)->first();
//        return $article;
        return view('blog.detail',compact('article'));
    }
    public function baseOnCategory($slug){
        $id=Category::where('slug',$slug)->first();
        $articles=Article::when(isset(request()->search),function($q){
            $search=request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where("category_id",$id->id)->with(['user','category'])->latest('id')->paginate(6);
//        return $articles;
        return view('welcome',compact('articles'));
    }
    public function baseOnUser($id){
        $articles=Article::when(isset(request()->search),function($q){
            $search=request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where("user_id",$id)->with(['user','category'])->latest('id')->paginate(6);
//        return $articles;
        return view('welcome',compact('articles'));
    }
    public function baseOnDate($date){
        $articles=Article::when(isset(request()->search),function($q){
            $search=request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where("created_at","like","%$date%")->with(['user','category'])->latest('id')->paginate(6);
//        return $articles;
        return view('welcome',compact('articles'));
    }

}
