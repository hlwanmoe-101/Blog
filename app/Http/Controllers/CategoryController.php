<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $cat=Category::all();
//        foreach ($cat as $c) {
//            $c->slug=Str::slug($c->title);
//            $c->update();
//        }
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           "category"=>"required|unique:categories,title",
        ]);
        $category= new Category();
        $category->title=$request->category;
        $category->slug=Str::slug($request->category)."-".uniqid();
        $category->user_id=Auth::id();
        $category->save();
        return redirect()->route('category.index')->with("message","New category created");
    //    $category=new Category();$category->title="Programming";$category->user_id=1;$category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "category"=>"required|unique:categories,title,".$category->id
        ]);
        $category->title=$request->category;
        $category->slug=Str::slug($request->category)."-".uniqid();
        $category->update();
        return redirect()->route('category.index')->with("message","Category updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with("message","Category deleted");
    }
}
