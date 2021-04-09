<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $floors = Floor::get();
    //     return view('floor.index',['floors'=>$floors]);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('floor.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(FloorRequest  $request)
    // {
    //     $validated = $request->validated();
    //     Floor::create($validated);
    //     $request->session()->flash('message',__('floors.notifications.created_succesfully'));
    //     return redirect(route('category.index'));
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Category $category)
    // {
    //     return view('floor.show',['category',$category]);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Category $category)
    // {
    //     return view('floor.edit',['category',$category]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(FloorRequest $request, Category $category)
    // {
    //     $validated = $request->validated();
    //     $category->name = $validated->name;
    //     $category->type = $validated->type;
    //     $category->save();
    //     $request->session()->flash('message',__('floors.notifications.created_succesfully'));
    //     return redirect(route('category.index'));
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Category $category)
    // {
    //     $category->delete();
    //     $request->session()->flash('message',__('floors.notifications.deleted_succesfully'));
    //     return redirect(route('category.index'));
    // }
}
