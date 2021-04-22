<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::get();
        return view('admin.geo.zones.index',['zones'=>$zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.geo.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $validated = $request->validated();
        Zone::create($validated);
        $request->session()->flash('message',__('geo.zones.massages.created_successfully'));
        return redirect(route('zones.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        return view('admin.geo.zones.edit',['zone'=>$zone,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
        $validated = $request->validated();
        $zone->update($validated);
        $request->session()->flash('message',__('geo.zones.massages.updated_successfully'));
        return redirect(route('zones.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Zone $zone)
    {
        $zone->delete();
        $request->session()->flash('message',__('geo.zones.massages.deleted_successfully'));
        return redirect(route('zones.index'));
    }
}
