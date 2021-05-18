<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\SubcategoryRequest;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::get();
        return view('admin.subcategories.index',['subcategories'=>$subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('add-category')) {
            $categories = Category::get();
            return view('admin.subcategories.create',['categories'=>$categories]);
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
    public function store(SubcategoryRequest  $request)
    {
        if (Auth::user()->hasPermissionTo('add-category')) {
            $validated = $request->validated();
            Subcategory::create($validated);
            $request->session()->flash('message',__('subcategories.massages.created_succesfully'));
            return redirect(route('subcategories.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return view('admin.subcategories.show',['category',$subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        if (Auth::user()->hasPermissionTo('edit-category')) {
            $categories = Category::get();
            return view('admin.subcategories.edit',[
                'subcategory'=>$subcategory,
                'categories'=>$categories,
            ]);
        }else {
            abort(503);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, Subcategory $subcategory)
    {
        if (Auth::user()->hasPermissionTo('edit-category')) {
            $validated = $request->validated();
            $subcategory->update ($validated);
            $request->session()->flash('message',__('subcategories.massages.updated_succesfully'));
            return redirect(route('subcategories.index'));
        }else {
            abort(503);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Subcategory $subcategory)
    {
        if (Auth::user()->hasPermissionTo('delete-category')) {
            $subcategory->delete();
            $request->session()->flash('message',__('subcategories.massages.deleted_succesfully'));
            return redirect(route('subcategories.index'));
        }else {
            abort(503);
        }
    }
}
