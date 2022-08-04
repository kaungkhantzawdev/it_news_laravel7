<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['getUser','getCategory'])->latest('id')->paginate(6);
        return view('welcome', compact('articles'));
    }

    public function show($slug){
        $article = Article::where('slug',$slug)->first();
        return view('blog.detail', compact('article'));
    }

    public function baseOnCategory($slug){
        $articles = Article::where("slug_category",$slug)->with(['getUser','getCategory'])->latest('id')->paginate(6);
        return view('welcome', compact('articles'));
    }

    public function baseOnUser($user_id){
        $articles = Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            return $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where("user_id",$user_id)->with(['getUser','getCategory'])->latest('id')->paginate(6);
        return view('welcome', compact('articles'));
    }

    public function baseOnDate($date){
        $articles = Article::whereDate("created_at",$date)->with(['getUser','getCategory'])->latest('id')->paginate(6);
        return view('welcome', compact('articles'));
    }

}
