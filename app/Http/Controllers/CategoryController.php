<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::get();
        return view('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('add-category')) {
            return view('admin.categories.create');
        }else {
            abort(503);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest  $request)
    {
        if (Auth::user()->hasPermissionTo('add-category')) {
            $validated = $request->validated();
            Category::create($validated);
            $request->session()->flash('message',__('categories.massages.created_succesfully'));
            return redirect(route('categories.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',['category',$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->hasPermissionTo('edit-category')) {
            return view('admin.categories.edit',['category'=>$category,]);
        }else {
            abort(503);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if (Auth::user()->hasPermissionTo('edit-category')) {
            $validated = $request->validated();
            $category->update ($validated);
            $request->session()->flash('message',__('categories.massages.updated_succesfully'));
            return redirect(route('categories.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request,Category $category)
    {
        if (Auth::user()->hasPermissionTo('delete-category')) {
            $category->delete();
            $request->session()->flash('message',__('categories.massages.deleted_succesfully'));
            return redirect(route('categories.index'));
        }else {
            abort(503);
        }
    }
}
