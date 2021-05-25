<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use App\User;
use App\Zone;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id','DESC')->with(['user:name,id'])->get();
        return view('admin.users.clients.index',['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $zones = Zone::get(['name','id']);

        return view('admin.users.clients.create',['zones'=>$zones]);
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
        //dd($addresses);
        $validated['type'] = 0;
        $validated['is_admin'] = 0;
        $user = User::create($validated);
        $client = $user->client()->create([
            'user_id'   =>$user->id,
        ]);

        if ($client){
            $user->phones()->createMany($request->group_a);

            $addresses = $request->group_b;
            foreach ($addresses as $key => $address){
                unset ($addresses[$key]);
                $new_key = $address['zone'];
                $addresses[$new_key] = [
                    'address' =>$address['address']
                ];
            }
            $client->zones()->sync($addresses);
        }
        $request->session()->flash('success',__('clients.massages.created_successfully'));
        return redirect(route('clients.index'));
    }

    public function ajaxStore(Request $request)
    {

        $validated = $request->all();
        //dd($addresses);
        $validated['type'] = 0;
        $validated['is_admin'] = 0;
        $user = User::create($validated);
        $client = $user->client()->create(['user_id'=>$user->id]);
        //dd($validated);
        if ($client){
            $user->phones()->create(["user_id"=>$user->id,"number"=>$validated['number']]);

            //$addresses = $request->number;
//            foreach ($addresses as $key => $address){
//                unset ($addresses[$key]);
//                $new_key = $address['zone'];
//                $addresses[$new_key] = [
//                    'address' =>$address['address']
//                ];
//            }
            $client->zones()->attach([
                $validated['zone'] =>[
                    'address' => $validated['address']
                ]
            ]);
        }
        return response()->json([
            'data' => $client
        ],200);
//        $request->session()->flash('success',__('clients.massages.created_successfully'));
//        return redirect(route('clients.index'));
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
        return view('admin.users.clients.view',['client'   => $client]);
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
        $zones        = Zone::all();
        $clientZones  = $client->zones;
        $phones = $client->user->phones->pluck('number');
        return view('admin.users.clients.edit',[
            'client'   => $client,
            'clientZones'=>$clientZones,
            'zones'=>$zones,
            'phones'=>$phones
        ]);
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
        $validated['type'] = 1;
        $validated['is_admin'] = 1;
        // dd($validated);
        $client->user->update($validated);
        // $client->update($validated);
        $request->session()->flash('success',__('clients.massages.update_successfully'));
        return redirect(route('clients.index'));
    }

    public function viewSearch()
    {
        $zones   = Zone::all();
        $clients = Client::orderBy('id','DESC')->with(['user:name,id'])->get();
        //dd($clients);
        return view('admin.users.clients.search',['clients'=>$clients,'zones'=>$zones]);
    }
    public function search()
    {

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
        return redirect(route('admin.users.clients.index'));
    }

}
