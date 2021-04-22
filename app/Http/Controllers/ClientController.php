<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id','DESC')->get();
        return view('admin.clients.index',['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ClientRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();
        Client::create($validated);
        $request->session()->flash('success',__('clients.massages.created_successfully'));
        return redirect(route('admin.clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Client $client)
    {
        return view('admin.clients.view',['client'   => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit',['client'   => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ClientRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $validated = $request->validated();
        $client->update($validated);
        $request->session()->flash('success',__('clients.massages.update_successfully'));
        return redirect(route('admin.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientRequest $request, Client $client)
    {
        $client->delete();
        $request->session()->flash('message',__('clients.massages.deleted_successfully'));
        return redirect(route('admin.clients.index'));
    }
}
