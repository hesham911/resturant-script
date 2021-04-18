<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::get();
        return view('admin.settings.index',['settings'=>$settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest  $request)
    {
        $validated = $request->validated();
        Setting::create($validated);
        $request->session()->flash('message',__('settings.notifications.created_succesfully'));
        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return view('admin.settings.show',['setting' => $setting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $categories = Setting::get();
        return view('admin.settings.edit',[
            'setting'=>$setting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Subsetting $setting)
    {
        $validated = $request->validated();
        $setting->update ($validated);
        $request->session()->flash('message',__('settings.notifications.updated_succesfully'));
        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Setting $setting)
    {
        $setting->delete();
        $request->session()->flash('message',__('settings.notifications.deleted_succesfully'));
        return redirect(route('settings.index'));
    }
}
